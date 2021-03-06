<?php
include_once "controller/BaseController.php";
include_once "controller/ConnectionController.php";
include_once "controller/RegistrationController.php";
include_once "controller/FilmController.php";
include_once "controller/FilmFormController.php";
include_once "controller/HomeController.php";
include_once "controller/ErrorController.php";

class IndexRouter {

    public $controllers;

    function __construct() {

        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
            session_reset();
        }

        $this->controllers = [
            'connection' => new ConnectionController(),
            'registration' => new RegistrationController(),
            'film' => new FilmController(),
            'filmform' => new FilmFormController(),
            'home' => new HomeController(),
            //'error' => new ErrorController()
        ];

        $page = &$_GET['page'];
        $action = &$_GET['action'];
        $connected = &$_SESSION['user'];
        $errormsg = &$_SESSION['error'];
        $successmsg = &$_SESSION['success'];

        //handle the actions of each pages
        if(isset($action) && $action) {
            $action = strtolower($action);
            if($action == 'disconnect')
                $this->disconnect();
            if($this->isInControllers($action)) 
                $this->controllers[$action]->handler();
        }

        //TODO: check connection on actions
        //check the connection
        if(!(isset($connected) && $connected)) {
            if($page != "connection" && $page != "registration")
                BaseController::redirectToPage("connection");
        }
        else {
            if($page == "connection" || $page == "registration")
                BaseController::redirectToPage("home");
        }
        
        //handle the view of each pages
        if(isset($page) && $page && $this->isInControllers($page)) {
            $page = strtolower($page);
            $this->controllers[$page]->index();
        }
        else
            BaseController::redirectToPage("home");
        
        //clear messages
        $errormsg = null;
        $successmsg = null;
    }

    function isInControllers($input) {
        return in_array($input, array_keys($this->controllers));
    }

    function disconnect() {
        session_unset();
        session_destroy();
    }
}

try {
    new IndexRouter();
} catch (\Throwable $th) {
    BaseController::getView('error', $th);
}