<?php
namespace Controllers;
require_once(ROOT_PATH . '/core/Render.php');
include_once(ROOT_PATH . "/app/models/CartItem.php");
include_once(ROOT_PATH . "/app/models/Cart.php");
include_once(ROOT_PATH . "/app/models/Product.php");

use Models\Cart;
use Models\CartItem;
use Models\Product;
use PDO;
use PDOException;

class CartController
{
    public function loadCart($vars): void
    {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cerco il carrello
        $carrello = array();
        if (isset($_SESSION['cart']))
        {
            $carrello = $_SESSION['cart'];
        }
        else
        {
            if(isset($_SESSION["account_id"]))
            {
                $cart= CartItem::findByAccountId($pdo, $_SESSION["account_id"]);
            }
            // altrimenti se il cookie è settato cerco con quello
            else if(isset($_COOKIE["cart_id"]))
            {
                $cart = CartItem::findByCartId($pdo, $_COOKIE["cart_id"]);
            }
            if(isset($cart))
                foreach($cart as $cartItem)
                    $carrello[ $cartItem["product_id"] ] = $cartItem["quantity"];
        }
        $_SESSION['cart'] = $carrello;

        // invio il carrello in json
        $this->loadCartJson($pdo, $carrello);
    }

    public function addProduct($vars)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($vars["product"]))
        {
            $product_id = $vars["product"];
            $product_id = str_replace('%20', ' ', $product_id);
        }
        else return;

        try
        {
            $pdo = new PDO(CONNECTION, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            // se il prodotto esiste e ha quantità positiva lo aggiungo
            $row = Product::findByName($pdo, $product_id);

            if($row && $row["quantity"] > 0)
            {
                // guardo se esiste già un carrello, altrimenti lo creo
                $cart_id = $this->findCarrello($pdo);

                // cerco il prodotto nel carrello
                $cartItem = CartItem::findByCartIdAndProductId($pdo, $cart_id, $product_id);

                // se esiste già il prodotto aumento la quantità
                if($cartItem)
                {
                    CartItem::updateByOne($pdo, new CartItem($cart_id, $product_id));
                }
                // altrimenti aggiungo il prodotto
                else
                {
                    CartItem::add($pdo, new CartItem($cart_id, $product_id));
                }
                $pdo->commit();

                // AGGIORNO SESSION[cart]
                $this->addToSession($product_id);
            }
        }
        catch (PDOException $e)
        {
            if($pdo->inTransaction())
                $pdo->rollBack();
            throw $e;
        }
    }

    public function removeProduct($vars)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($vars["product"]))
        {
            $product_id = $vars["product"];
            $product_id = str_replace('%20', ' ', $product_id);
        }
        else return;

        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();

        // se è un utente cerco il carrello con account_id
        if(isset($_SESSION["account_id"]))
        {
            $cart = Cart::findByAccountId($pdo, $_SESSION["account_id"]);
            if($cart)
                $cart_id = $cart['id'];
            else return;
        }
        // altrimenti se il cookie è settato cerco con quello
        else if(isset($_COOKIE["cart_id"]))
        {
            $cart_id = $_COOKIE["cart_id"];
        }
        else return;

        // elimino il prodotto dal carrello
        CartItem::delete($pdo, new CartItem($cart_id, $product_id));

        $this->removeFromSession($product_id);
    }

    /* ========================= FUNZIONI DI UTILITA ========================= */

    private function addToSession($product) : void
    {
        // se esiste già il carrello lo aggiungo/aggiorno
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart']))
        {
            if (array_key_exists($product, $_SESSION['cart']))
            {
                $_SESSION['cart'][$product] += 1;
            }
            else
            {
                $_SESSION['cart'][$product] = 1;
            }
        }
        else
        {
            // se non esiste creo il carrello
            $_SESSION['cart'] = array($product => 1);
        }
    }

    private function removeFromSession($product) : void
    {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart']))
        {
            if (array_key_exists($product, $_SESSION['cart']))
            {
                unset($_SESSION['cart'][$product]);
            }
        }
    }

    private function findCarrello($pdo)
    {
        // se è un utente cerco il carrello con account_id
        if(isset($_SESSION["account_id"]))
        {
            $cart = Cart::findByAccountId($pdo, $_SESSION["account_id"]);
            if($cart)
            {
                return $cart["id"];
            }
            return Cart::add($pdo, $_SESSION["account_id"]);
        }
        // altrimenti se il cookie è settato cerco con quello
        else if(isset($_COOKIE["cart_id"]))
        {
            $cart = Cart::findById($pdo, $_COOKIE["cart_id"]);
            if($cart)
            {
                return $cart["id"];
            }
            return Cart::add($pdo);
        }
        // altrimenti creo un nuovo carrello per il guest
        setcookie("cart_id", session_id(), time()+86400, '/'); // carrello dura 1g per i guest
        return Cart::add($pdo);
    }

    private function loadCartJson($pdo, $carrello)
    {
        if ($carrello)
        {
            $arrayProdotti = array();
            $array_to_question_marks = implode(',', array_fill(0, count($carrello), '?'));
            $stmt = $pdo->prepare('SELECT * 
                                   FROM product 
                                   WHERE name IN (' . $array_to_question_marks . ')');
            $stmt->execute(array_keys($carrello));

            // per ogni prodotto creo un elemento della lista
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
            {
                $arrayProdotti[json_encode($row)] = $carrello[$row["name"]];
            }
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($arrayProdotti);
        }
        else
            echo '{}';
    }
}