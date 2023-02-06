<?php
namespace Ecommerce;
use Controllers;

require_once(ROOT_PATH . '/app/controllers/PageController.php');
require_once(ROOT_PATH . '/app/controllers/CartController.php');
require_once(ROOT_PATH . '/app/controllers/ShopController.php');
require_once(ROOT_PATH . '/app/controllers/OrderController.php');

class Router
{
    private $routes = [];
    private $parameters = [];

    public static function load(string $file) : Router
    {
        $router = new static;

        require_once $file;

        return $router;
    }

    public function addRoute(string $route, array $params = []) : void
    {
        // Escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z0-9]+)\}/', '(?P<\1>[a-z0-9-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+} for numbers
        $route = preg_replace('/\{([a-z0-9]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimeter
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    public function setParams(string $uri) : void
    {
        // Store parameters for current 'controller' and 'action'
        foreach ($this->routes as $route => $params) {

            if (preg_match($route, $uri, $matches)) {

                foreach ($matches as $key => $match) {

                    if (is_string($key)) {
                        if ($key === 'controller') {
                            $match = ucwords($match);
                        }
                        $params[$key] = $match;
                    }
                }

                $this->parameters = $params;
            }
        }
    }

    public function redirect($uri) : void
    {
        $this->setParams($uri);

        $controller = 'Controllers\\' . $this->parameters['controller'];
        $action = $this->parameters['action'];

        if (class_exists($controller))
        {
            $controller = new $controller;

            unset($this->parameters['controller']);

            if (is_callable([$controller, $action])) {
                unset($this->parameters['action']);
                unset($this->parameters['namespace']);
            }
            else
            {
                die('Page not found.');
            }
        }
        else
        {

        }
        call_user_func_array([$controller, $action], [$this->parameters]);
    }
}