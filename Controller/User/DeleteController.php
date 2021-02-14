<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

/**
 * Class DeleteController
 */
class DeleteController extends UserController
{
    function __construct()
    {
        session_start();
        $this->deleteUserAction();
    }

    /**
     * This deletes a user account
     */
    private function deleteUserAction()
    {
        try {
            if (empty($_GET['id']) || !isset($_GET['id'])) {
                $this->createResponseFailer(400, 'BadRequest');
            }

            $id =  $_GET['id'];
            if ($id === $_SESSION['id']) {
                $this->createResponseFailer(400, 'Unable to delete current session client');
            }

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
