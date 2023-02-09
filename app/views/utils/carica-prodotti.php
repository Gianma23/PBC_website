<?php

use Models\Product;

include_once(ROOT_PATH . "/app/models/Product.php");

try {
    $pdo = new PDO(CONNECTION, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM product;";
    $result = $pdo->query($sql);

    while($row = $result->fetch()) {
        $prodotto = new Product($row);
        $prodotto->createProductCard();
    }
    $pdo = null;
}
catch (PDOException $e) {
    $pdo = null;
}