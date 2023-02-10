<?php
namespace Controllers;
require_once(ROOT_PATH . '/core/Render.php');
include_once(ROOT_PATH . "/app/models/Product.php");

use Models\Beer;
use Models\Cart;
use Models\CartItem;
use Models\Product;
use PDO;
use PDOException;

class ProductController
{
    public function addProduct() : void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["role"] == "admin") {

            header('Content-Type: application/json; charset=utf-8');
            if($this->validateInputs()) {

                $nome = $_POST["nome"];
                $desc = $_POST["desc"];
                $prezzo = $_POST["prezzo"];
                $quantita = $_POST["quantita"];
                $tagline = $_POST["tagline"];
                $categoria = $_POST["categoria"];

                $target_dir = ROOT_PATH . "/public/images/birre/";
                $target_file = $target_dir.basename($_FILES["image"]["name"]);

                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo json_encode(array('success' => false, 'text' => 'Errore nel caricamento dell\'immagine.'));
                    return;
                }

                // inserisco il prodotto
                $pdo = new PDO(CONNECTION, USER, PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                Product::add($pdo, $nome, $desc, $quantita, $tagline, $prezzo, $categoria, $target_file);

                // se è una birra inserisco anche quella
                if($categoria == "birra" && $this->validateBeerInputs()) {
                    Beer::addBeer($pdo, $nome, $_POST["stile"], $_POST["aroma"], $_POST["gusto"]);
                }

                echo json_encode(array('success' => true, 'text' => URL_ROOT. '/admin-prodotti'));
            }
        }
    }

    public function removeProduct($vars) : void
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($vars["product"]) && $_SESSION["role"] == "admin")
        {
            $product_id = $vars["product"];
            $product_id = str_replace('%20', ' ', $product_id);
            echo $product_id;
        }
        else return;

        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        Product::delete($pdo, $product_id);
    }

    /* ========================= FUNZIONI DI UTILITA ========================= */

    private function validateInputs() : bool {
       /* if (strlen($nome) < 20 &&
            is_numeric($quantita) && $quantita >= 0 && $quantita == round($quantita) &&
            is_numeric($prezzo) && $prezzo >= 0 &&
            in_array($categoria, ["birra", "merchandising", "altro"]) &&
            strlen($desc) < 500 && strlen($tagline) < 100)
            return true;*/


        if($_FILES["image"]["error"] == UPLOAD_ERR_OK)
            return true;
        RETURN true;
    }

    private function validateBeerInputs($stile, $aroma, $gusto) {
        return true;
    }
}