<?php
namespace Controllers;
require_once(ROOT_PATH . '/core/Render.php');
include_once(ROOT_PATH . "/app/models/Address.php");
include_once(ROOT_PATH . "/app/models/Cart.php");
include_once(ROOT_PATH . "/app/models/Product.php");
include_once(ROOT_PATH . "/app/models/Order.php");
include_once(ROOT_PATH . "/app/models/OrderItem.php");
use Ecommerce\Render;
use Models\Address;
use Models\Cart;
use Models\CartItem;
use Models\Order;
use Models\OrderItem;
use Models\Product;
use PDO;
use PDOException;

class OrderController
{
    public function addOrder()
    {
        header('Content-Type: application/json; charset=utf-8');
        if (isset($_SESSION['account_id']))
        {
            $account = $_SESSION['account_id'];
            $email = null;
        }
        else if (isset($_POST["email"]))
        {
            $account = null;
            $email = $_POST["email"];
        }
        else
        {
            echo json_encode(array('success' => false, 'text' => 'Necessaria email o account.'));
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if ($this->validateInputs()/*TODO: validare*/)
                $this->effettuaOrdine($account, $email);
            else
                echo json_encode(array('success' => false, 'text' => 'inputs non validi.'));
        }
    }

    public function getOrders()
    {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $ordini = array();
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION["role"]) && $_SESSION["role"] == 'admin'
            && isset($_GET['page']) && isset($_GET['how-many']))
        {
            $page = $_GET['page'];
            $howMany = $_GET['how-many'];
            $start = ($page - 1) * $howMany;
            $ordini = Order::findFromTo($pdo, $start, intval($howMany));
        }
        else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION["role"]) && isset($_SESSION["account_id"]))
        {
            $ordini = Order::findByAccountId($pdo, $_SESSION["account_id"]);
        }

        // conto gli ordini presenti
        $count = Order::getCount($pdo);

        // invio gli ordini in json
        $this->loadOrdersJson($ordini, $count);
    }

    public function getOrderItems($vars)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($vars["order"]))
        {
            $order_id = $vars["order"];
        }
        else return;

        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $items = OrderItem::findByOrderId($pdo, $order_id);

        if(isset($items))
            foreach($items as $item)
                $items[ $item["product_id"] ] = $item["quantity"];

        //TODO: controllo account ordine e account richiedente

        // invio gli ordini in json
        $this->loadOrderItemsJson($pdo, $items);
    }

    public function updateStatus() {

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['order']) && isset($_GET['status']))
        {
            $orderId = $_GET['order'];
            $status = $_GET['status'];

            if(!in_array($status, ['elaborazione', 'in transito', 'spedito', 'cancellato']))
                exit();

            $pdo = new PDO(CONNECTION, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            Order::updateStatus($pdo, $orderId, $status);
        }
    }

    /* ========================= FUNZIONI DI UTILITA ========================= */

    private function effettuaOrdine($account, $email)
    {
        // prendo il carrello dalla sessione
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
        {
            $cart = $_SESSION['cart'];
        }
        else
        {
            echo json_encode(array('success' => false, 'text' => 'carrello vuoto.'));
            return;
        }

        try {
            $pdo = new PDO(CONNECTION, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            // guardo se i prodotti sono ancora tutti disponibili,
            // li decremento altrimenti faccio un rollback
            foreach($cart as $nomeProdotto => $pezzi)
            {
                $prodotto = Product::findByName($pdo, $nomeProdotto);
                if($prodotto['quantity'] < $pezzi)
                {
                    $pdo->rollBack();
                    echo json_encode(array('success' => false, 'text' => $nomeProdotto . ' non è più disponibile purtroppo.'));
                    return;
                }
                Product::decrementQuantity($pdo, $nomeProdotto, $pezzi);
            }

            // aggiungo l'indirizzo di consegna
            $addressId = Address::add($pdo, $_POST['nome'], $_POST['cognome'], $_POST['indirizzo'], $_POST['provincia'], $_POST['citta'], $_POST['cap'], $_POST['telefono'], $_POST['note']);
            // creo il nuovo ordine
            $orderId = Order::add($pdo, $account, $email, $addressId, $_POST['pagamento'], $_POST['totale-spedizione'], $_POST['totale']);
            // sposto il carrello nell'ordine
            foreach($cart as $nomeProdotto => $pezzi)
            {
                OrderItem::add($pdo, $orderId, $nomeProdotto, $pezzi);
            }

            // rimuovo carrello
            $this->rimuoviCarrello($pdo);

            $pdo->commit();

            $_SESSION['confirmation'] = true;
            echo json_encode(array('success' => true, 'text' => URL_ROOT . '/conferma-ordine'));
        }
        catch (PDOException $e)
        {
            if($pdo->inTransaction())
                $pdo->rollBack();
            echo json_encode(array('success' => false, 'text' => 'Al momento il servizio non è disponibile.'));
            throw $e;
        }
    }

    private function rimuoviCarrello($pdo)
    {
        if(isset($_SESSION["account_id"]))
        {
            Cart::deleteByAccountId($pdo, $_SESSION["account_id"]);
        }
        if(isset($_COOKIE["cart_id"]))
        {
            Cart::delete($pdo, $_COOKIE["cart_id"]);
            setcookie("cart_id", null, -1, '/');
        }

        unset($_SESSION['cart']);
    }

    private function validateInputs()
    {
        return true;
    }

    private function loadOrdersJson($ordini, $count)
    {
        if ($ordini)
        {
            $arrayOrdini = array();

            foreach ($ordini as $ordine)
            {
                $arrayOrdini[] = json_encode(new Order($ordine));
            }
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['ordini' => $arrayOrdini, 'count' => $count]);
        }
        else
            echo '{}';
    }

    private function loadOrderItemsJson($pdo, $items)
    {
        if ($items)
        {
            $arrayItems = array();
            $array_to_question_marks = implode(',', array_fill(0, count($items), '?'));
            $stmt = $pdo->prepare('SELECT * 
                                   FROM product 
                                   WHERE name IN (' . $array_to_question_marks . ')');
            $stmt->execute(array_keys($items));

            // per ogni prodotto creo un elemento della lista
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
            {
                $arrayItems[json_encode($row)] = $items[$row["name"]];
            }

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($arrayItems);
        }
        else
            echo '{}';
    }
}

