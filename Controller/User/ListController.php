<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

/**
 * User Per Pages
 */
const PAGE = 5;

/**
 * Class ListController 
 */
class ListController extends UserController
{
    function __construct()
    {
    }

    /**
     * This retrieves the html structure of the user table 
     */
    public function getTableUsers()
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            return [];
        }
        $id = $_SESSION['id'];

        $keyFilter = $_GET['key'];
        $valueFilter = $_GET['value'];

        $db = new UserModel;
        $recordsNumber = $db->getNumberOfUsers($keyFilter, $valueFilter);

        $totalRecordsNumber = ceil(($recordsNumber - 1) / PAGE);
        $compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
        $left = ($compag - 1) * PAGE;
        $right =  PAGE;

        $increasePagination = (($compag + 1) <= $totalRecordsNumber) ? ($compag + 1) : 1;
        $decreasePagination = (($compag - 1)) < 1 ? 1 : ($compag - 1);

        $from = $compag - (ceil(PAGE / 2) - 1);
        $until = $compag + (ceil(PAGE / 2) - 1);

        $from = ($from < 1) ? 1 : $from;
        $until = ($until < PAGE) ? PAGE : $until;

        $users = $db->findWithoutUsingUserCurrent($id, $left, $right, $keyFilter, $valueFilter);
        return [
            'users' => $users,
            'inc' => $increasePagination,
            'dec' => $decreasePagination,
            'from' => $from,
            'until' => $until,
            'log_amount' => $totalRecordsNumber
        ];
    }
}

new ListController;
