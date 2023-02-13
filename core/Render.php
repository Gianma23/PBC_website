<?php
namespace Ecommerce;

class Render
{
    public static function view($view, $vars = []) : void
    {
        $file = ROOT_PATH. '/app/views/' . $view . '.php';

        extract($vars);

        if (is_readable($file))
        {
            require_once $file;
        }
        else
        {
            die('<h1> 404 Page not found </h1>');
        }
    }
}