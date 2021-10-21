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

        $this->controllers = [
            'connection' => new ConnectionController(),
            'registration' => new RegistrationController(),
            'film' => new FilmController(),
            'filmform' => new FilmFormController(),
            'home' => new HomeController(),
            'error' => new ErrorController()
        ];

        $page = &$_GET['page'];
        $action = &$_GET['action'];
        $connected = &$_SESSION['connected'];

        //handle the actions of each pages
        if(isset($action) && $action) {
            $action = strtolower($action);
            $action = strtolower($action);
            if($this->isInControllers($action)) 
                $this->controllers[$action]->handler();
            $this->controllers[$action]->handler();
        }
        
        //handle the view of each pages
        if(isset($page) && $page) {
            $page = strtolower($page);
            if(!$this->isInControllers($page)) 
                BaseController::redirectToPage("home");
            $this->controllers[$page]->index();
        }
        else
            BaseController::redirectToPage("home");
            
        //check the connection
        if(!(isset($connected) && $connected)) {
            if($page != "connection" && $page != "registration")
                BaseController::redirectToPage("connection");
        }   
        
    }

    function isInControllers($input) {
        return in_array($input, array_keys($this->controllers));
    }
}

try {
    new IndexRouter();
} catch (\Throwable $th) {
    BaseController::getView("error", $th);
}