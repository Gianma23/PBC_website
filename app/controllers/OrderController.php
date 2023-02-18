<?php
namespace Controllers;
require_once(ROOT_PATH . '/core/Render.php');
include_once(ROOT_PATH . "/app/models/Address.php");
include_once(ROOT_PATH . "/app/models/Cart.php");
include_once(ROOT_PATH . "/app/models/Product.php");
include_once(ROOT_PATH . "/app/models/Order.php");
include_once(ROOT_PATH . "/app/models/OrderItem.php");
include_once(ROOT_PATH . "/core/Validator.php");

use Ecommerce\Validator;
use Models\Address;
use Models\Cart;
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
            if ($this->validateInputs($account, $email))
            {
                $this->effettuaOrdine($account, $email);
            }
        }
    }

    public function getOrders()
    {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $ordini = array();
        $count = 0;

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['page']) && isset($_GET['how-many']))
        {
            $page = $_GET['page'];
            $howMany = $_GET['how-many'];
            $start = ($page - 1) * $howMany;

            // guardo se è un admin o uno user
            if (isset($_SESSION["role"]) && $_SESSION["role"] == 'admin')
            {
                $ordini = Order::findFromTo($pdo, $start, intval($howMany));
                $count = Order::getCount($pdo);
            }
            else if(isset($_SESSION["role"]) && $_SESSION["role"] == 'user')
            {
                $ordini = Order::findByAccountIdFromTo($pdo, $_SESSION["account_id"], $start, intval($howMany));
                $count = Order::getCountByAccountId($pdo, $_SESSION["account_id"]);
            }
        }
        else exit();

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

        // controllo che account ordine e account richiedente combacino
        if (Order::findById($pdo, $order_id)['account_id'] != $_SESSION['account_id'] && $_SESSION['role'] != 'admin')
            echo '{}';

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
            setcookie("cart_id", null, [
                'expires' => time()+1,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
        }

        unset($_SESSION['cart']);
    }

    private function validateInputs($account, $email)
    {
        if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['indirizzo']) && isset($_POST['provincia']) && isset($_POST['citta']) &&
            isset($_POST['cap']) && isset($_POST['telefono']) && isset($_POST['note']) && isset($_POST['pagamento']) && isset($_POST['totale-spedizione']) && isset($_POST['totale']))
        {
            if($account != null)
            {
                $emailValid = Validator::validateEmail($account) && Validator::validateLength($account, 100);
            }
            else
            {
                $emailValid = Validator::validateEmail($email) && Validator::validateLength($email, 100);
            }
            $nomeValid = Validator::validateText($_POST['nome']) && Validator::validateLength($_POST['nome'], 50);
            $cognomeValid = Validator::validateText($_POST['cognome']) && Validator::validateLength($_POST['cognome'], 50);
            $telValid = Validator::validateTelephone($_POST['telefono']);
            $cittaValid = Validator::validateText($_POST['citta']) && Validator::validateLength($_POST['citta'], 50);
            $capValid = Validator::validateCap($_POST['cap']);
            $pagamentoValid = in_array($_POST['pagamento'], ['carta', 'bonifico']);
            $spedizioneValid =  Validator::validateNatural($_POST['totale-spedizione']);
            $totaleValid = Validator::validateNatural($_POST['totale']);

            // controllo provincia
            $provinceJson =  file_get_contents(ROOT_PATH . '/core/utils/province.json');
            $province = json_decode($provinceJson, true);
            $provinceValid = false;
            foreach($province as $provincia)
            {
                if($provincia['nome'] == $_POST['provincia'])
                {
                    $provinceValid = true;
                    break;
                }
            }

            if($emailValid && $nomeValid && $cognomeValid && $telValid && $cittaValid &&
                $capValid && $pagamentoValid && $totaleValid && $spedizioneValid && $provinceValid)
            {
                return true;
            }
        }
        return false;
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

