<?php
include_once "controller/ViewsController.php";

class IndexRouter {
    static function main() {
        session_start();
        $page = (isset($_GET['page']) && !!$_GET['page'])? $_GET['page'] : "home";
        ViewsController::getView($page);
    }
}

try {
    IndexRouter::main();
} catch (\Throwable $th) {
    echo $th;
}