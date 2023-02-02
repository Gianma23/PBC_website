<?php
namespace Ecommerce;

require_once(__DIR__ . '/../core/config/config.php');
require_once(__DIR__ . '/../core/Router.php');
require_once(__DIR__ . '/../core/autoload.php');

session_start();

$router = new Router();
require_once(__DIR__ . '/../core/config/routes.php');

$router->redirect(getUri());


function getUri() : string
{
    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $uri = explode('/', $uri);
    array_shift($uri);
    $uri = implode('/', $uri);
    return $uri;
}