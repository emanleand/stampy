<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

/**
 * Class UpdateController 
 */
class UpdateController extends UserController
{
    function __construct()
    {
        $this->updateUserAction();
    }

    /**
     * This updates the data of an account
     */
    private function updateUserAction()
    {
        try {
            $input = json_decode(file_get_contents('php://input'), 1);
            $error = $this->validate($input);

            if (!isset($_GET['id']) || empty($_GET['id'])) {
                $this->createResponseFailer(400, 'BadRequest');
            }
            $id = $_GET['id'];

            if (!empty($error)) {
                $this->createResponseFailer(400, 'BadRequest');
            }

            if ($input['password'] !== $input['password_repeat']) {
                $this->createResponseFailer(400, 'BadRequest');
            }
            
            $db = new UserModel;
            $db->updateUser($input, $id);

            $this->createResponseSuccess(['message' => 'success']);
        } catch (Exception $e) {
            $this->createResponseFailer(409, 'Conflict');
        } catch (Throwable $e) {
            $this->createResponseFailer(409, 'Conflict');
        }
    }
}

new UpdateController;
