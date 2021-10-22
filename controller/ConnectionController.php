<?php
include_once './controller/BaseController.php';

class ConnectionController extends BaseController {

    function index() {
        if(isset($_SESSION['success']) && $_SESSION['success'])
            self::getView($_GET['page'], $_SESSION['success']);
        else
            parent::index();
    }

    function handler() {
        
    }
}