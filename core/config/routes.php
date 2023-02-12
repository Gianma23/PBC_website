<?php
namespace Ecommerce;

/* ======== PAGE CONTROLLER ======== */

$router->addRoute('home', ['controller' => 'PageController', 'action' => 'homepage']);
$router->addRoute('birrificio', ['controller' => 'PageController', 'action' => 'birrificio']);
$router->addRoute('taproom', ['controller' => 'PageController', 'action' => 'taproom']);
$router->addRoute('contatti', ['controller' => 'PageController', 'action' => 'contatti']);
$router->addRoute('shop', ['controller' => 'PageController', 'action' => 'shop']);
$router->addRoute('doc', ['controller' => 'PageController', 'action' => 'documentation']);
$router->addRoute('login', ['controller' => 'PageController', 'action' => 'login']);
$router->addRoute('carrello', ['controller' => 'PageController', 'action' => 'carrello']);
$router->addRoute('scaffale/{categoria:\w+}', ['controller' => 'PageController', 'action' => 'scaffale']);
$router->addRoute('scaffale', ['controller' => 'PageController', 'action' => 'scaffale']);
$router->addRoute('conferma-ordine', ['controller' => 'PageController', 'action' => 'confermaOrdine']);
$router->addRoute('checkout', ['controller' => 'PageController', 'action' => 'checkout']);
$router->addRoute('dettagli-ordine/{order:\d+}', ['controller' => 'PageController', 'action' => 'dettagliOrdine']);

// user routes
$router->addRoute('user-dashboard', ['controller' => 'PageController', 'action' => 'userDashboard']);
$router->addRoute('user-ordini', ['controller' => 'PageController', 'action' => 'userOrdini']);

// admin routes
$router->addRoute('admin-dashboard', ['controller' => 'PageController', 'action' => 'adminDashboard']);
$router->addRoute('admin-prodotti', ['controller' => 'PageController', 'action' => 'adminProdotti']);
$router->addRoute('admin-aggiungi-prodotto', ['controller' => 'PageController', 'action' => 'adminAggiungiProdotto']);
$router->addRoute('admin-ordini', ['controller' => 'PageController', 'action' => 'adminOrdini']);

/* ======== SHOP CONTROLLER ======== */

$router->addRoute('search/{categoria:\w+}', ['controller' => 'ShopController', 'action' => 'search']);
$router->addRoute('search', ['controller' => 'ShopController', 'action' => 'search']);

/* ======== CART CONTROLLER ======== */

$router->addRoute('carica-carrello', ['controller' => 'CartController', 'action' => 'loadCart']);
$router->addRoute('carrello/aggiungi/{product:.+}', ['controller' => 'CartController', 'action' => 'addProduct']);
$router->addRoute('carrello/rimuovi/{product:.+}', ['controller' => 'CartController', 'action' => 'removeProduct']);

/* ======== ORDER CONTROLLER ======== */

$router->addRoute('ordine/aggiungi', ['controller' => 'OrderController', 'action' => 'addOrder']);
$router->addRoute('ordine/carica-ordini', ['controller' => 'OrderController', 'action' => 'getOrders']);
$router->addRoute('ordine/carica-items-ordine/{order:\d+}', ['controller' => 'OrderController', 'action' => 'getOrderItems']);
$router->addRoute('ordine/aggiorna-stato', ['controller' => 'OrderController', 'action' => 'updateStatus']);

/* ======== AUTH CONTROLLER ======== */

$router->addRoute('auth/login', ['controller' => 'AuthController', 'action' => 'login']);
$router->addRoute('auth/register', ['controller' => 'AuthController', 'action' => 'register']);
$router->addRoute('auth/logout', ['controller' => 'AuthController', 'action' => 'logout']);

/* ======== EMAIL CONTROLLER ======== */

$router->addRoute('newsletter/add', ['controller' => 'EmailController', 'action' => 'addToNewsletter']);
$router->addRoute('invia-email', ['controller' => 'EmailController', 'action' => 'sendEmail']);

/* ======== PRODUCT CONTROLLER ======== */

$router->addRoute('admin/aggiungi-prodotto', ['controller' => 'ProductController', 'action' => 'addProduct']);
$router->addRoute('admin/elimina-prodotto/{product:.+}', ['controller' => 'ProductController', 'action' => 'removeProduct']);