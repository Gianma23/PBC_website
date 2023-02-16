<?php
namespace Ecommerce;
use Controllers;

require_once(ROOT_PATH . '/app/controllers/PageController.php');
require_once(ROOT_PATH . '/app/controllers/CartController.php');
require_once(ROOT_PATH . '/app/controllers/ShopController.php');
require_once(ROOT_PATH . '/app/controllers/OrderController.php');
require_once(ROOT_PATH . '/app/controllers/AuthController.php');
require_once(ROOT_PATH . '/app/controllers/EmailController.php');
require_once(ROOT_PATH . '/app/controllers/ProductController.php');

class Router
{
    private static $routes = [];
    private static $parameters = [];

    public static function addRoute(string $route, array $params = []) : void
    {
        $route = preg_replace('/\//', '\\/', $route);

        // Converto le variabili {var:.+} in RegExp
        $route = preg_replace('/\{([a-z0-9]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // aggiungo / /
        $route = '/^' . $route . '$/i';

        self::$routes[$route] = $params;
    }

    private static function setParams(string $uri) : void
    {
        // Metto in $parameters controller e azione
        foreach (self::$routes as $route => $params)
        {
            if (preg_match($route, $uri, $matches))
            {
                foreach ($matches as $key => $match)
                {
                    if (is_string($key))
                    {
                        if ($key === 'controller')
                        {
                            $match = ucwords($match);
                        }
                        $params[$key] = $match;
                    }
                }
                self::$parameters = $params;
            }
        }
    }

    public static function redirect($uri) : void
    {
        self::setParams($uri);

        $controller = 'Controllers\\' . self::$parameters['controller'];
        $action = self::$parameters['action'];

        if (class_exists($controller))
        {
            $controller = new $controller;

            unset(self::$parameters['controller']);

            if (is_callable([$controller, $action]))
            {
                unset(self::$parameters['action']);
                unset(self::$parameters['namespace']);
            }
            else
            {
                die('404 Page not found.');
            }
        }
        else
        {
           header('Location:' . URL_ROOT . '/home');
        }

        call_user_func_array([$controller, $action], [self::$parameters]);
    }
}