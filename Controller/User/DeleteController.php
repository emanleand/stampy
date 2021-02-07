<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

class DeleteController extends UserController
{
    function __construct()
    {
        $this->deleteUserAction();
    }

    private function deleteUserAction()
    {
        try {
            if (empty($_GET['id']) || !isset($_GET['id'])) {
                $this->createResponseFailer(400, 'BadRequest');
            }
            $id =  $_GET['id'];

            $db = new UserModel;
            $response = $db->removeUser($id);

            if (!$response) {
                $this->createResponseFailer(403, 'Resource not found');
            }

            $this->createResponseSuccess(['message' => 'success']);
        } catch (Exception $e) {
            $this->createResponseFailer(409, 'Conflict');
        } catch (Throwable $e) {
            $this->createResponseFailer(409, 'Conflict');
        }
    }
}

new DeleteController;
