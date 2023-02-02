<?php
include_once "../../app/php/utils/DBUtils.php";
include_once "../../app/php/classes/BeerClass.php";


if($_SERVER["REQUEST_METHOD"] == "GET")
    if(isset($_GET["categoria"]) && $_GET["categoria"] == "birra")
        cercaBirre();
    else if(isset($_GET["categoria"]))
        cercaProdotti();
    else if(isset($_GET["nome"]))
        cercaPerNome();

function cercaBirre() : void {
    $arrayProdotti = [];

    try {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * 
                FROM product 
                     INNER JOIN 
                     beer b on product.name = b.product_id 
                WHERE category = 'birra'";

        // aumento la select se ci sono altri parametri nella GET
        if(isset($_GET["stile"]))
            $sql .= " AND style = ?";
        // altri possibili parametri da poter aggiungere qui

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $_GET["stile"]);
        $stmt->execute();

        while($row = $stmt->fetch()) {
            $arrayProdotti[] = json_encode(new BeerClass($row));
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($arrayProdotti);
        $pdo = null;
    }
    catch (PDOException $e) {
        $pdo = null;
    }
}

function cercaProdotti() : void {
    $arrayProdotti = [];

    try {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM product WHERE category = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $_GET["categoria"]);
        $stmt->execute();

        $row = $stmt->fetch();
        if(isset($row) && !empty($row)) {
            $prodotto = new ProductClass($row);
            $arrayProdotti[] = $prodotto;
        }
        echo json_encode($arrayProdotti);
        $pdo = null;
    }
    catch (PDOException $e) {
        $pdo = null;
    }
}

function cercaPerNome() : void {
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
            $prodotto = new ProductClass($row);
            $arrayProdotti[] = $prodotto;
        }
        $pdo = null;
    }
    catch (PDOException $e) {
        $pdo = null;
    }
}