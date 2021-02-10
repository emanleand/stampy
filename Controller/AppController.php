<?php

/**
 * Class AppController 
 * 
 * @Description This class unifies the processes common to all controllers
 * 
 */
class AppController
{
    /**
     *
     * This will result in a failer response code.
     *
     * @param $code
     * @param $message
     *
     * @return Response
     */
    protected function createResponseFailer(int $code, string $message)
    {
        $response = ['code' => $code, 'message' => $message];
        echo json_encode($response);
        die();
    }

    /**
     *
     * This will result in a 200 response code.
     *
     * @param $code
     * @param $data
     *
     * @return Response
     */
    protected function createResponseSuccess(array $data)
    {
        $response = array_merge(['code' => 200], $data);
        echo json_encode($response);
        die();
    }
}
