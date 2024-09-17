<?php

namespace App\Controllers;

use App\Models\Font;
use App\Requests\FontRequest;

class FontController
{
    public function upload(): void
    {
        $fontRequest = new FontRequest();

        if ($fontRequest->validateUpload($_FILES['font'])) {
            $font = new Font();
            if ($font->upload($_FILES['font'])) {
                echo json_encode(['code' => 200, 'status' => 'success', 'message' => 'Font uploaded successfully']);
            } else {
                echo json_encode(['code' => 500, 'status' => 'error', 'message' => 'Font upload failed']);
            }
        } else {
            echo json_encode(value: ['code' => 415, 'status' => 'error', 'message' => 'Invalid file. Only TTF files are allowed.']);
        }
    }

    public function list(): void
    {
        header('Content-Type: application/json');
        $font = new Font();
        $fonts = $font->getAllFonts();
        echo json_encode(['status' => 'success', 'data' => $fonts]);
    }


    public function delete(): void
    {
        header('Content-Type: application/json');
        $fontRequest = new FontRequest();
        $id = $_POST['id'] ?? null;
        if ($fontRequest->validateDelete($id)) {
            $font = new Font();
            if ($font->delete((int)$id)) {
                echo json_encode(['status' => 'success', 'message' => 'Font deleted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Font deletion failed']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        }
    }
    public function getAllFonts(): void
    {
        header('Content-Type: application/json');
        $font = new Font();
        $fonts = $font->getAllFontsAjax();
        echo json_encode(['status' => 'success', 'data' => $fonts]);
    }
}
