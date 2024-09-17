<?php

namespace App\Requests;

class FontGroupRequest
{

    public function validateCreate(string $groupName, array $fonts): bool
    {
        if (empty($groupName) || count($fonts) < 2) {
            return false;
        }

        foreach ($fonts as $font) {
            if (empty($font['font_name']) || empty($font['font_ids'])) {
                return false;
            }
        }

        return true;
    }
    public function validateUpdate(int $groupId, string $groupName, array $fonts): bool
    {
        if (empty($groupId) || empty($groupName) || count($fonts) < 2) {
            return false;
        }

        foreach ($fonts as $font) {
            if (empty($font['font_name']) || empty($font['font_ids'])) {
                return false;
            }
        }

        return true;
    }

    public function validateDelete($id): bool
    {
        return is_numeric($id) && $id > 0;
    }
}
