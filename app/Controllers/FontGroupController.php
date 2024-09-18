<?php

namespace App\Controllers;

use App\Models\FontGroup;
use App\Requests\FontGroupRequest;
use App\Controllers\BaseController;

class FontGroupController extends BaseController
{
    public function create(): void
    {
        if ($this->isAjax()) {
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);

            $groupName = $data['group_name'] ?? '';
            $fonts = $data['fonts'] ?? [];

            $fontGroupRequest = new FontGroupRequest();

            if ($fontGroupRequest->validateCreate($groupName, $fonts)) {
                $fontGroup = new FontGroup();
                if ($fontGroup->createGroup($groupName, $fonts)) {
                    $this->jsonResponse(['code' => 200, 'status' => 'success', 'message' => 'Font group created successfully']);
                } else {
                    $this->jsonResponse(['code' => 400, 'status' => 'error', 'message' => 'Font group creation failed']);
                }
            } else {
                $this->jsonResponse(['code' => 400, 'status' => 'error', 'message' => 'Invalid input or less than 2 fonts selected']);
            }
        } else {
            include(__DIR__ . '/../views/layouts/layout.php');
        }
    }

    public function list(): void
    {
        if ($this->isAjax()) {
            $fontGroup = new FontGroup();
            $groups = $fontGroup->getAllGroups();
            $this->jsonResponse(['code' => 200, 'status' => 'success', 'data' => $groups]);
        } else {
            include(__DIR__ . '/../views/layouts/layout.php');
        }
    }

    public function edit(): void
    {
        if ($this->isAjax()) {
            $id = $_GET['id'] ?? null;
            $fontGroup = new FontGroup();
            $groupData = $fontGroup->getGroupById((int)$id);
            $this->jsonResponse(['status' => 'success', 'data' => $groupData]);
        } else {
            include(__DIR__ . '/../views/invalid_request_page.php');
        }
    }

    public function update(): void
    {
        if ($this->isAjax()) {
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);

            $groupId = $data['group_id'] ?? '';
            $groupName = $data['group_name'] ?? '';
            $fonts = $data['fonts'] ?? [];

            $fontGroupRequest = new FontGroupRequest();

            if ($fontGroupRequest->validateUpdate($groupId, $groupName, $fonts)) {
                $fontGroup = new FontGroup();
                if ($fontGroup->updateGroup($groupId, $groupName, $fonts)) {
                    $this->jsonResponse(['code' => 200, 'status' => 'success', 'message' => 'Font group updated successfully']);
                } else {
                    $this->jsonResponse(['code' => 500, 'status' => 'error', 'message' => 'Font group update failed']);
                }
            } else {
                $this->jsonResponse(['code' => 400, 'status' => 'error', 'message' => 'Invalid input or less than 2 fonts selected']);
            }
        } else {
            include(__DIR__ . '/../views/invalid_request_page.php');
        }
    }

    public function delete(): void
    {
        if ($this->isAjax()) {
            $fontGroupRequest = new FontGroupRequest();
            $id = $_POST['id'] ?? null;

            if ($fontGroupRequest->validateDelete($id)) {
                $fontGroup = new FontGroup();
                if ($fontGroup->deleteGroup((int)$id)) {
                    $this->jsonResponse(['code' => 200, 'status' => 'success', 'message' => 'Font group deleted successfully']);
                } else {
                    $this->jsonResponse(['code' => 400, 'status' => 'error', 'message' => 'Font group deletion failed']);
                }
            } else {
                $this->jsonResponse(['code' => 400, 'status' => 'error', 'message' => 'Invalid request']);
            }
        } else {
            include(__DIR__ . '/../views/invalid_request_page.php');
        }
    }
}
