<?php
include_once "../../app/php/utils/DBUtils.php";

session_start();
if($_SESSION["account"] != "admin")
    return;

$nome = "";
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nome"]))
    $nome = $_GET["nome"];

try {
    $pdo = new PDO(CONNECTION, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM product WHERE name = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $nome);
    $stmt->execute();

    $pdo = null;
} catch (PDOException $e) {
    echo $e->getMessage();
    $pdo = null;
}