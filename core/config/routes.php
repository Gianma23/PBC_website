<?php
namespace Ecommerce;
define('WEB_ROOT', substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], '/index.php')));
// Static pages routes
$router->addRoute('', ['controller' => 'PageController', 'action' => 'homepage']);
$router->addRoute('home', ['controller' => 'PageController', 'action' => 'homepage']);
$router->addRoute('birrificio', ['controller' => 'PageController', 'action' => 'birrificio']);
$router->addRoute('taproom', ['controller' => 'PageController', 'action' => 'taproom']);
$router->addRoute('contatti', ['controller' => 'PageController', 'action' => 'contatti']);
$router->addRoute('shop', ['controller' => 'PageController', 'action' => 'shop']);

