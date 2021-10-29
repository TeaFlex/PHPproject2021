<?php
include_once './controller/BaseController.php';

class HomeController extends BaseController {

    function index() {
        $sql = new AccessSQL();
        $sql->init();

        $data = [
            'error' => (isset($_SESSION['error']))? $_SESSION['error']: null,
            'movies' => $sql->getAllEntries("movies"),
        ];

        $sql = null;
        self::getView($_GET['page'], $data);
    }

    function handler() {
        
    }
}