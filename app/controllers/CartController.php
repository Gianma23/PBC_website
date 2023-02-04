<?php
namespace Controllers;
require_once(ROOT_PATH . '/core/Render.php');
include_once(ROOT_PATH . "/app/models/CartItem.php");
use Models\CartItem;
use PDO;
use PDOException;

class CartController
{
    public function loadCart(): void
    {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $carrello = array();
        if (isset($_SESSION['cart']))
        {
            $carrello = $_SESSION['cart'];
        }
        else
        {
            $stmt = "";
            if(isset($_SESSION["account_id"]))
            {
                $sql = "SELECT product_id, quantity
                        FROM cart
                             INNER JOIN
                             cart_item ci on cart.id = ci.cart_id
                        WHERE account_id=?;";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $_SESSION["account_id"]);
                $stmt->execute();
            }
            // altrimenti se il cookie è settato cerco con quello
            else if(isset($_COOKIE["cart_id"]))
            {
                $sql = "SELECT product_id, quantity
                        FROM cart_item
                        WHERE cart_id=?;";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $_COOKIE["cart_id"]);
                $stmt->execute();
            }
            if($stmt)
                while($cart_item = $stmt->fetch(PDO::FETCH_ASSOC))
                    $carrello[ $cart_item["product_id"]] = $cart_item["quantity"];
        }

        $this->loadCartTemplate($pdo, $carrello);
    }

    public  function addProduct($vars) : void
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($vars["product"]))
        {
            $product_id = $vars["product"];

            try
            {
                $pdo = new PDO(CONNECTION, USER, PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->beginTransaction();

                $sql = "SELECT * FROM product WHERE name=?;";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $product_id);
                $stmt->execute();

                // se il prodotto esiste e ha quantità positiva lo aggiungo
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row && $row["quantity"] > 0)
                {
                    // AGGIUNGO NEL DATABASE
                    // guardo se esiste già un carrello, altrimenti lo creo
                    $cart_id = $this->findCarrello($pdo);

                    // cerco il prodotto nel carrello
                    $stmt = $this->cercaProdottoInCarrello($pdo, $cart_id, $product_id);

                    // se esiste già il prodotto aumento la quantità
                    if($stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $sql = "UPDATE cart_item
                                SET quantity = quantity + 1
                                WHERE cart_id=? AND product_id = ?;";
                    }
                    // altrimenti aggiungo il prodotto
                    else
                    {
                        $sql = "INSERT INTO cart_item (cart_id, product_id, quantity)
                                VALUE (?,?,1);";
                    }
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(1, $cart_id);
                    $stmt->bindValue(2, $product_id);
                    $result = $stmt->execute();

                    // AGGIORNO SESSION[cart]
                    $this->addToSession($product_id);

                    $pdo->commit();
                }
            }
            catch (PDOException $e)
            {
                if($pdo->inTransaction())
                    $pdo->rollBack();
                throw $e;
            }
        }
    }

    public function removeProduct($vars)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($vars["product"]))
        {
            $product_id = $vars["product"];

            try
            {
                $pdo = new PDO(CONNECTION, USER, PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->beginTransaction();

                // se è un utente cerco il carrello con account_id
                if(isset($_SESSION["account_id"]))
                {
                    $sql = "SELECT * 
                            FROM cart
                                 INNER JOIN
                                 cart_item ci on cart.id = ci.cart_id
                            WHERE account_id=?;";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(1, $_SESSION["account_id"]);
                    $stmt->execute();
                    if($cart = $stmt->fetch(PDO::FETCH_ASSOC))
                        $cart_id = $cart['id'];
                    else return;
                }
                // altrimenti se il cookie è settato cerco con quello
                else if(isset($_COOKIE["cart_id"]))
                {
                    $cart_id = $_COOKIE["cart_id"];
                }
                else return;

                // elimino il prodotto
                $sql = "DELETE
                        FROM cart_item
                        WHERE  cart_id = ? AND product_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $cart_id);
                $stmt->bindValue(2, $product_id);
                $stmt->execute();

                $this->removeFromSession($product_id);
            }
            catch (PDOException $e)
            {
                if($pdo->inTransaction())
                    $pdo->rollBack();
                throw $e;
            }
        }
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
            $sql = "SELECT * 
                    FROM cart
                    WHERE account_id=?;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $_SESSION["account_id"]);
            $stmt->execute();

            if($cart = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                return $cart["id"];
            }
            return $this->createNewCart($pdo, $_SESSION["account_id"]);
        }
        // altrimenti se il cookie è settato cerco con quello
        else if(isset($_COOKIE["cart_id"]))
        {
            $sql = "SELECT * 
                    FROM cart
                    WHERE id=?;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $_COOKIE["cart_id"]);
            $stmt->execute();

            if($cart = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                return $cart["id"];
            }
            return $this->createNewCart($pdo);
        }
        // altrimenti creo un nuovo carrello per il guest
        setcookie("cart_id", session_id(), time()+86400, '/'); // carrello dura 1g per i guest
        return $this->createNewCart($pdo);
    }

    private function createNewCart($pdo, $account = null) : string
    {
        $sql = "INSERT INTO cart (id, account_id)
                VALUES (?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, session_id());
        $stmt->bindValue(2, $account);
        $stmt->execute();
        return session_id();
    }

    private function cercaProdottoInCarrello($pdo, $cart_id, $product_id)
    {
        $sql = "SELECT * 
                FROM cart_item
                WHERE cart_id=? AND product_id = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $cart_id);
        $stmt->bindValue(2, $product_id);
        $stmt->execute();
        return $stmt;
    }

    private function loadCartTemplate($pdo, $carrello)
    {
        header('Content-Type: text/html; charset=utf-8');
        if ($carrello)
        {
            $array_to_question_marks = implode(',', array_fill(0, count($carrello), '?'));
            $stmt = $pdo->prepare('SELECT * 
                                   FROM product 
                                   WHERE name IN (' . $array_to_question_marks . ')');
            $stmt->execute(array_keys($carrello));

            // per ogni prodotto creo un elemento della lista
            $totale = 0;
            while($row = $stmt->fetch())
            {
                $cartItem = new CartItem($row, $carrello[$row["name"]]);
                $totale += $cartItem->getPrezzo() * $cartItem->getPezzi();
                ?>
                <li class="prodotto">
                    <div>
                        <img src="<?= $cartItem->getImgPath()?>" alt="<?= $cartItem->getNome()?>">
                    </div>
                    <div class="info-prodotto-carrello">
                        <p class="nome-prodotto"><?= $cartItem->getNome()?></p>
                        <p class="prezzo-prodotto"><?= $cartItem->getPezzi()?> &times; <?= $cartItem->getPrezzo()?>&euro;</p>
                    </div>
                    <button class="remove-prodotto">&times;</button>
                </li>
                <?php
            }
            echo '<p class="totale">Subtotale:&emsp;' . $totale . '&euro;</p>';
        }
    }
}