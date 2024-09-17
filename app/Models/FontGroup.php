<?php

namespace App\Models;

use Core\Database;

class FontGroup
{
    public function createGroup(string $groupName, array $fonts): bool
    {
        $db = Database::getInstance()->getConnection();
        $db->begin_transaction();

        try {
            // Insert into font_groups
            $stmt = $db->prepare("INSERT INTO font_groups (group_name) VALUES (?)");
            $stmt->bind_param('s', $groupName);
            $stmt->execute();

            $groupId = $stmt->insert_id; // Get the last inserted group ID

            // Insert into font_group_details for each font
            foreach ($fonts as $font) {
                $fontId = $font['font_ids'];
                $fontName = $font['font_name'];
                $stmt = $db->prepare("INSERT INTO font_group_details (font_group_id, font_id, font_name) VALUES (?, ?, ?)");
                $stmt->bind_param('iis', $groupId, $fontId, $fontName);
                $stmt->execute();
            }

            $db->commit(); // Commit the transaction
            return true;
        } catch (\Exception $e) {
            $db->rollback();
            return false;
        }
    }

    public function getAllGroups(): array
    {
        $db = Database::getInstance()->getConnection();
        $result = $db->query("
        SELECT fg.id AS group_id, fg.group_name, 
               GROUP_CONCAT(f.name SEPARATOR ', ') AS fonts, 
               COUNT(f.id) AS font_count
        FROM font_groups fg
        JOIN font_group_details fgd ON fg.id = fgd.font_group_id
        JOIN fonts f ON fgd.font_id = f.id
        GROUP BY fg.id
    ");

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function deleteGroup(int $groupId): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM font_groups WHERE id = ?");
        $stmt->bind_param('i', $groupId);
        return $stmt->execute();
    }
    public function getGroupById(int $groupId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        SELECT fg.id AS group_id, fg.group_name, fgd.font_id, fgd.font_name
        FROM font_groups fg
        JOIN font_group_details fgd ON fg.id = fgd.font_group_id
        WHERE fg.id = ?
    ");
        $stmt->bind_param('i', $groupId);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

        if (empty($rows)) {
            return [];
        }

        return [[
            'group_id' => $rows[0]['group_id'],
            'group_name' => $rows[0]['group_name'],
            'fonts' => array_map(fn($row) => [
                'font_id' => $row['font_id'],
                'font_name' => $row['font_name']
            ], $rows)
        ]];
    }


    public function updateGroup(int $groupId, string $groupName, array $fontDetails): bool
    {
        $db = Database::getInstance()->getConnection();
        $db->begin_transaction();

        try {
            $stmt = $db->prepare("UPDATE font_groups SET group_name = ? WHERE id = ?");
            $stmt->bind_param('si', $groupName, $groupId);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM font_group_details WHERE font_group_id = ?");
            $stmt->bind_param('i', $groupId);
            $stmt->execute();

            foreach ($fontDetails as $font) {

                if (!isset($font['font_ids']) || empty($font['font_ids']) || !isset($font['font_name']) || empty($font['font_name'])) {
                    throw new \Exception('Invalid font data: font_id or font_name is missing.');
                }

                $fontId = $font['font_ids'];
                $fontName = $font['font_name'];


                $stmt = $db->prepare("INSERT INTO font_group_details (font_group_id, font_id, font_name) VALUES (?, ?, ?)");
                $stmt->bind_param('iis', $groupId, $fontId, $fontName);
                $stmt->execute();
            }

            $db->commit();
            return true;
        } catch (\Exception $e) {
            $db->rollback();
            error_log($e->getMessage());
            return false;
        }
    }
}
