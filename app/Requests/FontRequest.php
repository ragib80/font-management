<?php

namespace App\Requests;

class FontRequest
{

    public function validateUpload($file): bool
    {
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (strtolower($fileExtension) === 'ttf' && $file['error'] === 0) {
            return true;
        }

        return false;
    }


    public function validateDelete($id): bool
    {
        return is_numeric($id) && $id > 0;
    }
}
