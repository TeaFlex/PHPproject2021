<?php
include_once './controller/BaseController.php';
include_once './model/AccessSQL.php';

class RegistrationController extends BaseController {

    function index() {
        parent::index();
        // $sql = new AccessSQL();
        // $sql->init();
        // $sql->insertInto('users', [
        //     "user_name" => "test",
        //     "user_hashpwd" => password_hash("test", null),
        //     "user_email" => "test@test.com"
        // ]);
        // $sql = null;
    }

    function handler() {

    }
}