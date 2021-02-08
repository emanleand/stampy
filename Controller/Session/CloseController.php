<?php

include_once __DIR__ . '/SessionController.php';

/**
 * Class CloseController
 */
class CloseController extends SessionController
{
    function __construct()
    {
        $this->logOutSessionAction();
    }

    /**
     * This destroys the current session in the system
     */
    private function logOutSessionAction()
    {
        try {
            session_start();
            session_unset();
            session_destroy();
            $this->createResponseSuccess(['message' => 'success']);
        } catch (Exception $e) {
            $this->createResponseFailer(409, 'Conflict');
        } catch (Throwable $e) {
            $this->createResponseFailer(409, 'Conflict');
        }
    }
}

new CloseController;
