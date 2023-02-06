<?php
namespace Models;

include_once __DIR__ . "/Product.php";

class OrderItem
{
    private $orderId;
    private $productId;
    private $pezzi;

    function __construct($cartId, $productId, $pezzi = 1)
    {
        $this->cartId = $cartId;
        $this->productId = $productId;
        $this->pezzi = $pezzi;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    public function getPezzi()
    {
        return $this->pezzi;
    }

    public function setPezzi($pezzi)
    {
        $this->pezzi = $pezzi;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /* CRUD OPERATIONS */

    public static function add($pdo, $orderId, $productId, $quantity)
    {
        $sql = "INSERT INTO order_item (order_id, product_id, quantity)
                VALUE (?,?,?);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $orderId);
        $stmt->bindValue(2, $productId);
        $stmt->bindValue(3, $quantity);
        return $stmt->execute();
    }

    public static function findByCartIdAndProductId($pdo, $cartId, $productId)
    {
        $sql = "SELECT * 
                FROM cart_item
                WHERE cart_id=? AND product_id = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $cartId);
        $stmt->bindValue(2, $productId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function findByAccountId($pdo, $account)
    {
        $sql = "SELECT product_id, quantity
                FROM cart
                     INNER JOIN
                     cart_item ci on cart.id = ci.cart_id
                WHERE account_id=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $account);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findByOrderId($pdo, $cartId)
    {
        $sql = "SELECT product_id, quantity
                        FROM cart_item
                        WHERE cart_id=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $cartId);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}