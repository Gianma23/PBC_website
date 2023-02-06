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

    public function login()
    {
        Render::view('login');
    }
}