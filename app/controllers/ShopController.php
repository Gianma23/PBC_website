<?php
namespace Controllers;
require_once(ROOT_PATH . '/core/Render.php');
require_once(ROOT_PATH . '/app/models/Product.php');
require_once(ROOT_PATH . '/app/models/Beer.php');

use Ecommerce\Render;
use Models\Product;
use Models\Beer;
use PDO;
use PDOException;

class ShopController {

    public function scaffale($vars) {
        Render::view('scaffale');
    }


    public function search($vars)
    {
        if(isset($vars['categoria']))
            $this->searchByCategory($vars['categoria']);
    }

    private function searchByCategory($categoria) : void
    {
        $arrayProdotti = [];

        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * 
            FROM product 
                 INNER JOIN 
                 beer b on product.name = b.product_id 
            WHERE category = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $categoria);
        $stmt->execute();

        while($row = $stmt->fetch()) {
            $arrayProdotti[] = json_encode(new Beer($row));
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($arrayProdotti);
    }


    private function searchByName() : void
    {
        global $arrayProdotti;

        try {
            $pdo = new PDO(CONNECTION, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM product WHERE category = ?;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $_GET["categoria"]);
            $stmt->execute();

            $row = $stmt->fetch();
            if(isset($row) && !empty($row)) {
                $prodotto = new Product($row);
                $arrayProdotti[] = $prodotto;
            }
            $pdo = null;
        }
        catch (PDOException $e) {
            $pdo = null;
        }
    }
}