<?php

use Models\Product;

include_once "app/php/classes/Product.php";

try {
    $pdo = new PDO(CONNECTION, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM product;";
    $result = $pdo->query($sql);

    while($row = $result->fetch()) {
        $birra = new Product($row);
        $birra->createProductCard();
    }
    $pdo = null;
}
catch (PDOException $e) {
    $pdo = null;
}