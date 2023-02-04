<?php
namespace Ecommerce;

class Render {

    public static function view($view, $vars = []) : void {
        $file = ROOT_PATH. '/app/views/' . $view . '.php';

        extract($vars);
        // Check for view file
        if (is_readable($file)) {
            require_once $file;
        }
        else {
            // View does not exist
            die('<h1> 404 Page not found </h1>');
        }
    }
}