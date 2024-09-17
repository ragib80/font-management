<?php

namespace App\Requests;

// class FontRequest
// {
//     // Validate font upload (ensure it is a TTF file)
//     public function validateUpload($file): bool
//     {
//         return isset($file['name']) && pathinfo($file['name'], PATHINFO_EXTENSION) === 'ttf' || pathinfo($file['name'], PATHINFO_EXTENSION) === 'TTF';
//     }

//     // Validate deletion request (ensure the ID is provided and is valid)
//     public function validateDelete($id): bool
//     {
//         return is_numeric($id) && $id > 0;
//     }
// }
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
