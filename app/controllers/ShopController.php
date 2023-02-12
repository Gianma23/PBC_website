<?php
namespace Controllers;
require_once(ROOT_PATH . '/app/models/Product.php');
require_once(ROOT_PATH . '/app/models/Beer.php');

use Ecommerce\Render;
use Models\Product;
use Models\Beer;
use PDO;
use PDOException;

class ShopController
{
    public function search($vars = null): void
    {
        if(isset($vars['categoria']))
            $this->searchByCategory($vars['categoria']);
        else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nome']))
            $this->searchByName($_GET['nome']);
    }

    /* ========================= FUNZIONI DI UTILITA ========================= */

    private function searchByCategory($categoria) : void
    {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $prodotti = Product::findByCategory($pdo, $categoria);

        $this->loadProductJson($pdo, $prodotti);
    }

    private function searchByName($nome) : void
    {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $prodotti = Product::findBySubstringName($pdo, $nome);

        $this->loadProductJson($pdo, $prodotti);
    }

    private function loadProductJson($pdo, $prodotti): void
    {
        $arrayProdotti = [];
        foreach($prodotti as $prodotto) {
            if($prodotto['category'] == 'birra')
            {
                $beer = Beer::findByName($pdo, $prodotto['name']);
                $arrayProdotti[] = json_encode(new Beer($beer));
            }
            else
            {
                $arrayProdotti[] = json_encode(new Product($prodotto));
            }
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($arrayProdotti);
    }
}