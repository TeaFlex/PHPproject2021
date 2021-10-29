<?php
include_once './controller/BaseController.php';

class HomeController extends BaseController {

    function index(array $toappend = []) {
        $sql = new AccessSQL();
        $sql->init();

        $data = [
            'movies' => $sql->getAllEntries("movies"),
        ];

        $sql = null;
        parent::index($data);
    }

    function handler() {
        
    }
}