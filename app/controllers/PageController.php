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
        Render::view('user/user-dashboard');
    }

    public function userOrdini()
    {
        Render::view('user/user-ordini');
    }

    public function adminDashboard()
    {
        Render::view('admin/admin-dashboard');
    }

    public function adminProdotti()
    {
        Render::view('admin/admin-prodotti');
    }

    public function adminAggiungiProdotto()
    {
        Render::view('admin/admin-aggiungi-prodotto');
    }

    public function adminOrdini()
    {
        Render::view('admin/admin-ordini');
    }

    public function dettagliOrdine($vars)
    {
        Render::view('dettagli-ordine', $vars);
    }
}