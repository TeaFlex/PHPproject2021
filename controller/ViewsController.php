<?php

class ViewsController {
    static function getView(string $view) {
        $view = ucfirst(strtolower($view));
        $path = "views/{$view}.php";
        ob_start();
        if($view != "Template" && file_exists($path))
            require $path;
        $content = ob_get_clean();
        require 'views/Template.php';
    }
}