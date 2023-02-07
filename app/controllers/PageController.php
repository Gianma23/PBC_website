<?php
namespace Controllers;
require_once(ROOT_PATH . '/core/Render.php');
use Ecommerce\Render;

class PageController
{
    public function homepage()
    {
        Render::view('homepage');
    }

    public function documentation()
    {
        Render::view('documentation');
    }

    public function birrificio()
    {
        Render::view('birrificio');
    }

    public function taproom()
    {
        Render::view('taproom');
    }

    public function contatti()
    {
        Render::view('contatti');
    }

    public function shop()
    {
        Render::view('shop');
    }

    public function scaffale($vars) {
        Render::view('scaffale');
    }

    public function login()
    {
        Render::view('login');
    }

    public function carrello()
    {
        Render::view('carrello');
    }

    public function confermaOrdine()
    {
        Render::view('conferma-ordine');
    }

    public function checkout()
    {
        Render::view('checkout');
    }

    public function userDashboard()
    {
        Render::view('user-dashboard');
    }

    public function adminDashboard()
    {
        Render::view('admin-dashboard');
    }
}