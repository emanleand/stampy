<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

class EditController extends UserController
{
    function __construct()
    {
        $this->showUserAction();
    }

    private function showUserAction()
    {
        try {
            if (empty($_GET['id']) || !isset($_GET['id'])) {
                $this->createResponseFailer(400, 'BadRequest');
            }
            $id =  $_GET['id'];

            $db = new UserModel;
            $response = $db->find($id);

            if (!$response) {
                $this->createResponseFailer(403, 'Resource not found');
            }

            return $this->viewEditUser($response);
        } catch (Exception $e) {
            $this->createResponseFailer(409, 'Conflict');
        } catch (Throwable $e) {
            $this->createResponseFailer(409, 'Conflict');
        }
    }

    private function viewEditUser($data)
    {
?>
        <h3 class="title-register">User</h3>
        <form id="edit-user-form" class="form-register">
            <input type="text" name="first_name" value="<?php echo $data['first_name']; ?>">
            <input type="text" name="last_name" value="<?php echo $data['last_name']; ?>">
            <input type="text" name="username" value="<?php echo $data['username']; ?>">
            <input type="text" name="email" value="<?php echo $data['email']; ?>">
            <input type="password" name="password" value="<?php echo $data['password']; ?>">
            <input type="password" name="password_repeat" value="<?php echo $data['password']; ?>">
            <input type="submit" class="btn info" id="register" name="register" value="Save">
        </form>
<?php
    }
}

new EditController;
