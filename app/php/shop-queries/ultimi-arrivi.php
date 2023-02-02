<?php
include_once "app/php/utils/DBUtils.php";

try {
    $pdo = new PDO(CONNECTION, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CALL piu_vendute();";
    $result = $pdo->query($sql);

    echo "<ul>";
    while($birra = $result->fetch()) {
        echo "<li>$birra[sold]</li>";
    }
    echo "</ul>";
    $pdo = null;
}
catch (PDOException $e) {
    $pdo = null;
}