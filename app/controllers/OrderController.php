<?php
namespace Controllers;
require_once(ROOT_PATH . '/core/Render.php');
use Ecommerce\Render;

class OrderController
{
    public function carrello()
    {
        Render::view('carrello');
    }

    public function spedizione()
    {
        Render::view('spedizione');
    }

    public function checkout()
    {
        Render::view('checkout');
    }
}