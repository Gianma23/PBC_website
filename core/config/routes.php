<?php
namespace Ecommerce;

// Page Controller
$router->addRoute('home', ['controller' => 'PageController', 'action' => 'homepage']);
$router->addRoute('birrificio', ['controller' => 'PageController', 'action' => 'birrificio']);
$router->addRoute('taproom', ['controller' => 'PageController', 'action' => 'taproom']);
$router->addRoute('contatti', ['controller' => 'PageController', 'action' => 'contatti']);
$router->addRoute('shop', ['controller' => 'PageController', 'action' => 'shop']);
$router->addRoute('doc', ['controller' => 'PageController', 'action' => 'documentation']);
$router->addRoute('login', ['controller' => 'PageController', 'action' => 'login']);
$router->addRoute('carrello', ['controller' => 'PageController', 'action' => 'carrello']);
$router->addRoute('scaffale/{categoria:\w+}', ['controller' => 'PageController', 'action' => 'scaffale']);
$router->addRoute('conferma-ordine', ['controller' => 'PageController', 'action' => 'confermaOrdine']);
$router->addRoute('checkout', ['controller' => 'PageController', 'action' => 'checkout']);
$router->addRoute('user-dashboard', ['controller' => 'PageController', 'action' => 'userDashboard']);
$router->addRoute('admin-dashboard', ['controller' => 'PageController', 'action' => 'adminDashboard']);

// Shop Controller
$router->addRoute('scaffale/search/{categoria:\w+}', ['controller' => 'ShopController', 'action' => 'search']);

// Cart Controller
$router->addRoute('carica-carrello', ['controller' => 'CartController', 'action' => 'loadCart']);
$router->addRoute('scaffale/carica-carrello', ['controller' => 'CartController', 'action' => 'loadCart']);
$router->addRoute('carrello/aggiungi/{product:.+}', ['controller' => 'CartController', 'action' => 'addProduct']);
$router->addRoute('scaffale/carrello/aggiungi/{product:.+}', ['controller' => 'CartController', 'action' => 'addProduct']);
$router->addRoute('carrello/rimuovi/{product:.+}', ['controller' => 'CartController', 'action' => 'removeProduct']);
$router->addRoute('scaffale/carrello/rimuovi/{product:.+}', ['controller' => 'CartController', 'action' => 'removeProduct']);

// Order Controller
$router->addRoute('ordine/aggiungi', ['controller' => 'OrderController', 'action' => 'addOrder']);

// Auth Controller
$router->addRoute('auth/login', ['controller' => 'AuthController', 'action' => 'login']);
$router->addRoute('auth/register', ['controller' => 'AuthController', 'action' => 'register']);

// Email Controller
$router->addRoute('newsletter/add', ['controller' => 'AuthController', 'action' => 'addToNewsletter']);