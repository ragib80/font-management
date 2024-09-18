<?php

namespace App\Models;

use Core\Database;

class Font
{
    // public function upload($file): bool
    // {
    //     $targetDir = __DIR__ . '/../../public/fonts/';
    //     $targetFile = $targetDir . basename($file['name']);

    //     if (pathinfo($file['name'], PATHINFO_EXTENSION) !== 'ttf') {
    //         return false;
    //     }

    //     if (move_uploaded_file($file['tmp_name'], $targetFile)) {
    //         $db = Database::getInstance()->getConnection();
    //         $stmt = $db->prepare("INSERT INTO fonts (name, file) VALUES (?, ?)");
    //         $stmt->bind_param('ss', $file['name'], $targetFile);
    //         return $stmt->execute();
    //     }

    //     return false;
    // }
    public function upload($file): bool
    {
        $targetDir = __DIR__ . '/../../public/fonts/';
        $targetFile = $targetDir . basename($file['name']);

        if (pathinfo($file['name'], PATHINFO_EXTENSION) !== 'ttf') {
            return false;
        }

        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("INSERT INTO fonts (name, file) VALUES (?, ?)");
            $stmt->bind_param('ss', $fileName, $targetFile);
            return $stmt->execute();
        }

        return false;
    }


    public function getAllFonts(): array
    {
        $db = Database::getInstance()->getConnection();
        $result = $db->query("SELECT * FROM fonts");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function getAllFontsAjax(): array
    {
        $db = Database::getInstance()->getConnection();
        $result = $db->query("SELECT id,name FROM fonts");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function delete(int $id): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM fonts WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
