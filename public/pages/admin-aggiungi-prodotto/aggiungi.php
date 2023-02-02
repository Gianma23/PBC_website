<?php
include_once "app/php/utils/DBUtils.php";

$errorAggiungi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["role"] == "admin") {

    if(isset($_POST["nome"]) && isset($_POST["desc"]) && isset($_POST["prezzo"]) &&
        isset($_POST["quantita"]) && isset($_POST["categoria"]) && isset($_POST["stile"]) && isset($_POST["tagline"])
        && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {

        $nome = $_POST["nome"];
        $desc = $_POST["desc"];
        $prezzo = $_POST["prezzo"];
        $quantita = $_POST["quantita"];
        $tagline = $_POST["tagline"];
        $categoria = $_POST["categoria"];

        $target_dir = "app/images/birre/";
        $target_file = $target_dir.basename($_FILES["image"]["name"]);

        if(file_exists($target_file)) {
            $errorAggiungi =  "<small class=\"error\">Immagine già presente.</small>";
            return;
        }

        if(validateInputs($nome, $desc, $prezzo, $quantita, $categoria, $tagline)) {

            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $errorAggiungi =  "<small class=\"error\">Errore nel caricamento dell'immagine.</small>";
                return;
            }

            // inserisco il prodotto
            try {
                $pdo = new PDO(CONNECTION, USER, PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO product (name, descr, quantity, tagline, price, category, img_path) VALUES (?,?,?,?,?,?,?)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $nome);
                $stmt->bindValue(2, $desc);
                $stmt->bindValue(3, $quantita);
                $stmt->bindValue(4, $tagline);
                $stmt->bindValue(5, $prezzo);
                $stmt->bindValue(6, $categoria);
                $stmt->bindValue(7, $target_file);
                $stmt->execute();

                // se è una birra inserisco anche quella
                if($categoria == "birra" && isset($_POST["aroma"]) && isset($_POST["gusto"]) && isset($_POST["stile"])) {
                    $sql = "INSERT INTO beer (product_id, style, aroma, flavor) VALUES (?,?,?,?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(1, $nome);
                    $stmt->bindValue(2, $_POST["stile"]);
                    $stmt->bindValue(3, $_POST["aroma"]);
                    $stmt->bindValue(4, $_POST["gusto"]);
                    $stmt->execute();
                }
                redirectToProduct();
                $pdo = null;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                $errorAggiungi =  "<small class=\"error\">Siamo spiacenti, il servizio non è raggiungibile.</small>";
                $pdo = null;
            }
        }
    }
}

function validateInputs($nome, $desc, $prezzo, $quantita, $categoria, $tagline) : bool {
    return strlen($nome) < 20 &&
            is_numeric($quantita) && $quantita >= 0 && $quantita == round($quantita) &&
            is_numeric($prezzo) && $prezzo >= 0 &&
            in_array($categoria, ["birra", "merchandising", "altro"]) &&
            strlen($desc) < 500 && strlen($tagline) < 100;
}

function redirectToProduct() : void {
    $host = $_SERVER["HTTP_HOST"];
    $current_directory = rtrim(dirname($_SERVER["PHP_SELF"]), "/");
    header("Location: http://$host/$current_directory/admin-prodotti.php");
}
