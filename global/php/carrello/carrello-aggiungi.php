<?php
include_once "../utils/DBUtils.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["product_id"])) {

    $product_id = $_GET["product_id"];

    try {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM product WHERE name=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $product_id);
        $stmt->execute();

        // se il prodotto esiste e ha quantità positiva lo aggiungo
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row && $row["quantity"] > 0) {

            // AGGIUNGO NEL DATABASE
            // guardo se esiste già un carrello, altrimenti lo creo
            $cart_id = findCarrello($pdo);

            // aggiorno/aggiungo il prodotto nel carrello
            $sql = "SELECT * 
                    FROM cart_item
                    WHERE cart_id=? AND product_id = ?;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cart_id);
            $stmt->bindValue(2, $product_id);
            $stmt->execute();

            // se esiste già il prodotto aumento la quantità
            if($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $sql = "UPDATE cart_item
                        SET quantity = quantity + 1
                        WHERE cart_id=? AND product_id = ?;";
            }
            // altrimenti aggiungo il prodotto
            else {
                $sql = "INSERT INTO cart_item (cart_id, product_id, quantity)
                        VALUE (?,?,1);";
            }
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cart_id);
            $stmt->bindValue(2, $product_id);
            $stmt->execute();

            // AGGIORNO SESSION[cart]
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                updateSessionCart($row);
            }
            $pdo = null;
        }
    }
    catch (PDOException $e) {
        $pdo = null;
    }
}

function updateSessionCart($product) : void {
    // se esiste già il carrello lo aggiungo/aggiorno
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        if (array_key_exists($product, $_SESSION['cart'])) {
            $_SESSION['cart'][$product] += 1;
        } else {
            $_SESSION['cart'][$product] = 1;
        }
    } else {
        // se non esiste creo il carrello
        $_SESSION['cart'] = array($product => 1);
    }
}

function findCarrello($pdo) {
    // se è un utente cerco il carrello con account_id
    if(isset($_SESSION["account_id"])) {
        $sql = "SELECT * 
                FROM cart
                WHERE account_id=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION["account_id"]);
        $stmt->execute();

        if($cart = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $cart["id"];
        }
        return createNewCart($pdo, $_SESSION["account_id"]);
    }
    // altrimenti se il cookie è settato cerco con quello
    else if(isset($_COOKIE["cart_id"])) {
        $sql = "SELECT * 
                FROM cart
                WHERE id=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $_COOKIE["cart_id"]);
        $stmt->execute();

        if($cart = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $cart["id"];
        }
        return createNewCart($pdo);
    }
    // altrimenti creo un nuovo carrello per il guest
    return createNewCart($pdo);
}

function createNewCart($pdo, $account = null) {

    setcookie("cart_id", session_id());

    $sql = "INSERT INTO cart (id, account_id)
            VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, session_id());
    $stmt->bindValue(2, $account);
    $stmt->execute();
    return session_id();
}