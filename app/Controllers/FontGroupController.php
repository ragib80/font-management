<?php

namespace App\Controllers;

use App\Models\FontGroup;
use App\Requests\FontGroupRequest;

class FontGroupController
{
    public function create(): void
    {
        header('Content-Type: application/json');
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $groupName = $data['group_name'] ?? '';
        $fonts = $data['fonts'] ?? [];

        $fontGroupRequest = new FontGroupRequest();

        if ($fontGroupRequest->validateCreate($groupName, $fonts)) {
            $fontGroup = new FontGroup();
            if ($fontGroup->createGroup($groupName, $fonts)) {
                echo json_encode(['code' => 200, 'status' => 'success', 'message' => 'Font group created successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Font group creation failed']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input or less than 2 fonts selected']);
        }
    }

    public function list(): void
    {
        header('Content-Type: application/json');
        $fontGroup = new FontGroup();
        $groups = $fontGroup->getAllGroups();
        echo json_encode(['status' => 'success', 'data' => $groups]);
    }

    public function delete(): void
    {
        header('Content-Type: application/json');
        $fontGroupRequest = new FontGroupRequest();
        $id = $_POST['id'] ?? null;

        if ($fontGroupRequest->validateDelete($id)) {
            $fontGroup = new FontGroup();
            if ($fontGroup->deleteGroup((int)$id)) {
                echo json_encode(['status' => 'success', 'message' => 'Font group deleted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Font group deletion failed']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        }
    }
    public function edit(): void
    {
        header('Content-Type: application/json');
        $id = $_GET['id'] ?? null;
        $fontGroup = new FontGroup();
        $groupData = $fontGroup->getGroupById((int)$id);
        echo json_encode(['status' => 'success', 'data' => $groupData]);
    }

    public function update(): void
    {
        header('Content-Type: application/json');

        $input = file_get_contents('php://input');

        $data = json_decode($input, true);

        $groupId = $data['group_id'] ?? '';
        $groupName = $data['group_name'] ?? '';
        $fonts = $data['fonts'] ?? [];

        $fontGroupRequest = new FontGroupRequest();

        if (!$fontGroupRequest->validateUpdate($groupId, $groupName, $fonts)) {
            http_response_code(400); // Bad Request
            echo json_encode(['status' => 'error', 'message' => 'Invalid input or less than 2 fonts selected']);
            return;
        }

        $fontGroup = new FontGroup();
        if ($fontGroup->updateGroup($groupId, $groupName, $fonts)) {
            echo json_encode(['code' => 200, 'status' => 'success', 'message' => 'Font group updated successfully']);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['status' => 'error', 'message' => 'Font group update failed']);
        }
    }
}
