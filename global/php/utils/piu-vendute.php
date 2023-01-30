<?php
include_once "global/php/utils/DBUtils.php";
include_once "global/php/classes/ProductClass.php";

try {
    $pdo = new PDO(CONNECTION, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CALL piu_vendute();";
    $result = $pdo->query($sql);

    while($row = $result->fetch()) {
        $birra = new ProductClass($row);
        $birra->createShopCard();
    }
    $pdo = null;
}
catch (PDOException $e) {
    $pdo = null;
}