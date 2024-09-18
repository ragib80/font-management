<?php

namespace App\Controllers;

use App\Models\Font;
use App\Requests\FontRequest;
use App\Controllers\BaseController;

class FontController extends BaseController
{
    public function upload(): void
    {
        $fontRequest = new FontRequest();

        if ($this->isAjax()) {
            if ($fontRequest->validateUpload($_FILES['font'])) {
                $font = new Font();
                if ($font->upload($_FILES['font'])) {
                    $this->jsonResponse(['code' => 200, 'status' => 'success', 'message' => 'Font uploaded successfully']);
                } else {
                    $this->jsonResponse(['code' => 500, 'status' => 'error', 'message' => 'Font upload failed']);
                }
            } else {
                $this->jsonResponse(['code' => 415, 'status' => 'error', 'message' => 'Invalid file. Only TTF files are allowed.']);
            }
        } else {
            include(__DIR__ . '/../views/layouts/layout.php');
        }
    }

    public function list(): void
    {
        $font = new Font();
        $fonts = $font->getAllFonts();

        if ($this->isAjax()) {
            $this->jsonResponse(['code' => 200, 'status' => 'success', 'data' => $fonts]);
        } else {
            include(__DIR__ . '/../views/layouts/layout.php');
        }
    }

    public function delete(): void
    {
        if ($this->isAjax()) {
            $fontRequest = new FontRequest();
            $id = $_POST['id'] ?? null;

            if ($fontRequest->validateDelete($id)) {
                $font = new Font();
                if ($font->delete((int) $id)) {
                    $this->jsonResponse(['code' => 200, 'status' => 'success', 'message' => 'Font deleted successfully']);
                } else {
                    $this->jsonResponse(['code' => 500, 'status' => 'error', 'message' => 'Font deletion failed']);
                }
            } else {
                $this->jsonResponse(['code' => 400, 'status' => 'error', 'message' => 'Invalid request']);
            }
        } else {
            include(__DIR__ . '/../views/invalid_request_page.php');
        }
    }

    public function getAllFonts(): void
    {
        $font = new Font();
        $fonts = $font->getAllFontsAjax();

        if ($this->isAjax()) {
            $this->jsonResponse(['code' => 200, 'status' => 'success', 'data' => $fonts]);
        } else {
            include(__DIR__ . '/../views/invalid_request_page.php');
        }
    }
}
