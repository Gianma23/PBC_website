<?php
include_once "../utils/DBUtils.php";
include_once "../classes/CartItemClass.php";

session_start();
try {
    $pdo = new PDO(CONNECTION, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $products_in_cart = array();
    if (isset($_SESSION['cart'])) {
        $products_in_cart = $_SESSION['cart'];
    }
    else {
        $stmt = "";
        if(isset($_SESSION["account_id"])) {
            $sql = "SELECT product_id, quantity
                    FROM cart
                         INNER JOIN
                         cart_item ci on cart.id = ci.cart_id
                    WHERE account_id=?;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $_SESSION["account_id"]);
        }
        // altrimenti se il cookie è settato cerco con quello
        else if(isset($_COOKIE["cart_id"])) {
            $sql = "SELECT product_id, quantity
                FROM cart_item
                WHERE cart_id=?;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $_COOKIE["cart_id"]);
            $stmt->execute();
        }
        $stmt->execute();;
        while($cart_item = $stmt->fetch(PDO::FETCH_ASSOC))
            $products_in_cart[ $cart_item["product_id"]] = $cart_item["quantity"];
    }


// carico il carrello
    if ($products_in_cart) {
        $arrayProdotti = [];

        $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
        $stmt = $pdo->prepare('SELECT * FROM product WHERE name IN (' . $array_to_question_marks . ')');
        $stmt->execute(array_keys($products_in_cart));
        // Fetch the products from the database and return the result as an Array
        while($row = $stmt->fetch()) {
            $arrayProdotti[] = json_encode(new CartItemClass($row, $products_in_cart[$row["name"]]));
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($arrayProdotti);
        $pdo = null;
    }
}
catch (PDOException $e) {
    echo $e->getMessage();
    $pdo = null;
}


