<?php
include_once "../../global/php/utils/DBUtils.php";

$nome = "";
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nome"]))
    $nome = $_GET["nome"];

echo $nome;
try {
    $pdo = new PDO(CONNECTION, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM product WHERE product.name = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $nome);
    $stmt->execute();

    $pdo = null;
} catch (PDOException $e) {
    echo $e->getMessage();
    $pdo = null;
}
