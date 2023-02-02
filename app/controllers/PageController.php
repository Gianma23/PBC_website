<?php
namespace Controllers;
require_once(ROOT_PATH . '/core/Render.php');
use Ecommerce\Render;

class PageController {

    public function homepage() {
        Render::view('homepage');
    }

    public function birrificio() {
        Render::view('birrificio');
    }
}