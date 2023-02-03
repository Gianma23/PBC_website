<?php
include_once "app/php/classes/ProductClass.php";

try {
    $pdo = new PDO(CONNECTION, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM product;";
    $result = $pdo->query($sql);

    while($row = $result->fetch()) {
        $birra = new ProductClass($row);
        $birra->createProductCard();
    }
    $pdo = null;
}
catch (PDOException $e) {
    $pdo = null;
}