<?php
namespace Controllers;
include_once(ROOT_PATH . "/app/models/Product.php");

use Ecommerce\Validator;
use Models\Beer;
use Models\Product;
use PDO;

class ProductController
{
    public function getProduct($vars) : void
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && $_SESSION["role"] == "admin" && isset($vars['nome']))
        {
            $nome = str_replace('%20', ' ', $vars['nome']);

            header('Content-Type: application/json; charset=utf-8');
            $pdo = new PDO(CONNECTION, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $prodotto = Product::findByName($pdo, $nome);

            if($prodotto['category'] == 'birra')
                echo json_encode(Beer::findByName($pdo, $nome));
            else
                echo json_encode($prodotto);
        }
    }

    public function addProduct() : void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["role"] == "admin")
        {
            header('Content-Type: application/json; charset=utf-8');
            if($this->validateInputs()) {

                $action = $_POST['action'];
                $nome = $_POST["nome"];
                $desc = $_POST["desc"];
                $prezzo = $_POST["prezzo"];
                $quantita = $_POST["quantita"];
                $tagline = $_POST["tagline"];
                $categoria = $_POST["categoria"];

                $target_dir = ROOT_PATH . "/public/images/prodotti/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imgPath = "/public/images/prodotti/" .  basename($_FILES["image"]["name"]);

                $pdo = new PDO(CONNECTION, USER, PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if($action == 'AGGIUNGI')
                {
                    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                    {
                        echo json_encode(array('success' => false, 'text' => 'Errore nel caricamento dell\'immagine.'));
                        return;
                    }
                    // inserisco il prodotto
                    Product::add($pdo, $nome, $desc, $quantita, $tagline, $prezzo, $categoria, $imgPath);

                    if($categoria == "birra"/* && $this->validateBeerInputs()*/)
                    {
                        Beer::addBeer($pdo, $nome, $_POST["stile"], $_POST["aroma"], $_POST["gusto"]);
                    }
                }
                else if($action == 'SALVA')
                {
                    // rimuovo vecchia foto
                    $updatingProduct = Product::findByName($pdo, $nome);
                    unlink(ROOT_PATH . $updatingProduct['img_path']);

                    // aggiungo nuova foto
                    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                    {
                        echo json_encode(array('success' => false, 'text' => 'Errore nel caricamento dell\'immagine.'));
                        return;
                    }

                    // aggiorno il prodotto
                    Product::update($pdo, $nome, $desc, $quantita, $tagline, $prezzo, $categoria, $imgPath);

                    if($categoria == "birra")
                    {
                        Beer::updateBeer($pdo, $nome, $_POST["stile"], $_POST["aroma"], $_POST["gusto"]);
                    }
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

        $deletedProduct = Product::delete($pdo, $product_id);
        unlink(ROOT_PATH . $deletedProduct['img_path']);
    }

    /* ========================= FUNZIONI DI UTILITA ========================= */

    private function validateInputs() : bool
    {
        if (isset($_POST["nome"]) && isset($_POST["desc"]) && isset($_POST["prezzo"]) &&
            isset($_POST["quantita"]) && isset($_POST["tagline"]) && isset($_POST["categoria"]))
        {
            $validNome = Validator::validateLength($_POST["nome"], 50);
            $validTagline = Validator::validateLength($_POST['tagline'], 100);
            $validDesc = Validator::validateMessage($_POST['desc']);
            $validPrezzo = Validator::validateNatural($_POST['prezzo']);
            $validQuantita = Validator::validateNatural($_POST['quantita']);
            $validCategoria = in_array($_POST["categoria"], ['birra', 'merchandising', 'altro']);
            $validImage = false;
            if($_FILES["image"]["error"] == UPLOAD_ERR_OK)
                $validImage = Validator::validateImage($_FILES["image"]);

            $isFormValid = $validNome && $validTagline && $validDesc && $validPrezzo && $validQuantita && $validImage && $validCategoria;

            if($_POST["categoria"] == 'birra')
            {
                if(isset($_POST['stile']) && isset($_POST['aroma']) && isset($_POST['gusto']))
                {
                    $validStile = Validator::validateText($_POST['stile']) && Validator::validateLength($_POST['stile'], 50);
                    $validAroma = Validator::validateMessage($_POST['aroma']);
                    $validGusto = Validator::validateMessage($_POST['gusto']);
                    $isFormValid = $isFormValid && $validStile && $validAroma && $validGusto;
                }
                else return false;
            }
            if($isFormValid)
                return true;
        }
        return false;
    }

}