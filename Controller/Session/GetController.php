<?php

include_once __DIR__ . '/SessionController.php';

/**
 * Class GetController  
 */
class GetController extends SessionController
{
    function __construct()
    {
        session_start();
        $this->getSessionAction();
    }

    /**
     * This controls the state of the current session
     */
    private function getSessionAction()
    {
        try {
            if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
                $this->createResponseFailer(403, 'Resource not found');
            }

            $data['id'] = $_SESSION['id'];
            $data['username'] = $_SESSION['username'];

            $this->createResponseSuccess(['data' => $data]);
        } catch (Exception $e) {
            $this->createResponseFailer(409, 'Conflict');
        } catch (Throwable $e) {
            $this->createResponseFailer(409, 'Conflict');
        }
    }
}

new GetController;
