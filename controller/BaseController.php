<?php
include_once './model/AccessSQL.php';

abstract class BaseController {
    public const viewsDir = 'views';
    
    static function getComputedPath(string $view) {
        $view = ucfirst(strtolower($view));
        return implode('/', [self::viewsDir, $view.'.php']);
    }

    /**
     * Method executed when a page is requested.
     * By default, return the view associated to the controller
     */
    function index() {
        self::getView($_GET['page']);
    }
    
    /**
     * Method executed when an action is requested.
     * It needs to be implemented.
     */
    abstract function handler();

    static public function redirect(string $path) {
        header("Location: ".$path);
        exit();
    }

    static public function redirectToPage(string $page) {
        self::redirect("index.php?page=".$page);
    }

    static public function getView(string $view, mixed $data="") {
        $path = self::getComputedPath($view);
        ob_start();
        if($view != "Template" && file_exists($path))
            require $path;
        $content = ob_get_clean();
        require self::getComputedPath("Template");
    }

    static protected function getViewsList() {
        $arr = array_filter(scandir(self::viewsDir), function($el) {
            return $el != "Template.php" && preg_match("/.+\.php/m", $el);
        });
        return array_values($arr);
    }

    static protected function getSQLAccess() {
        $sql = new AccessSQL();
        $sql->init();
        return $sql;
    }
}