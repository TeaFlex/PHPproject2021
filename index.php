<?php
include_once "controller/BaseController.php";
include_once "controller/ConnectionController.php";
include_once "controller/RegistrationController.php";
include_once "controller/FilmController.php";
include_once "controller/FilmFormController.php";
include_once "controller/HomeController.php";
include_once "controller/ErrorController.php";

class IndexRouter {

    function __construct() {

        $controllers = [
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
            if(in_array($action, array_keys($controllers))) {
                $controllers[$action]->handler();
            }
            $controllers[$action]->handler();
        }
        

        //handle the view of each pages
        if(!(isset($page) && $page))
            $page = "home";
        // if(!(isset($connected) && $connected)) {
        //     if($page != "connection" && $page != "registration")
        //         $page = "connection";
        // }   
        $controllers[$page]->index();
    }
}

try {
    new IndexRouter();
} catch (\Throwable $th) {
    BaseController::getView("error", $th);
}