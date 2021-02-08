<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

/**
 * Class GetController  
 */
class GetController extends UserController
{
    function __construct()
    {
        $this->getUserAction();
    }

    /**
     * This retrieves the data for a specific user account
     */
    private function getUserAction()
    {
        try {
            if (empty($_GET['id']) || !isset($_GET['id'])) {
                $this->createResponseFailer(400, 'BadRequest');
            }
            $id =  $_GET['id'];

            $db = new UserModel;
            $user = $db->find($id);

            if (!$user) {
                $this->createResponseFailer(403, 'Resource not found');
            }

            $this->createResponseSuccess($user);
        } catch (Exception $e) {
            $this->createResponseFailer(409, 'Conflict');
        } catch (Throwable $e) {
            $this->createResponseFailer(409, 'Conflict');
        }
    }
}

new GetController;
