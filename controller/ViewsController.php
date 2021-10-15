<?php

class ViewsController {
    public const viewsDir = 'views';
    
    static function getComputedPath(string $view) {
        $view = ucfirst(strtolower($view));
        return implode('/', [self::viewsDir, $view.'.php']);
    }

    static function getView(string $view, mixed $data=[]) {
        $path = self::getComputedPath($view);
        ob_start();
        if($view != "Template" && file_exists($path))
            require $path;
        $content = ob_get_clean();
        require self::getComputedPath("Template");
    }

    static function getViewsList() {
        $arr = array_filter(scandir(self::viewsDir), function($el) {
            return $el != "Template.php" && preg_match("/.+\.php/m", $el);
        });
        return array_values($arr);
    }
}