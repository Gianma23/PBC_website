<?php
namespace Models;

include_once __DIR__ . "/Product.php";

class OrderItem
{
    private $orderId;
    private $productId;
    private $pezzi;

    function __construct($orderId, $productId, $pezzi = 1)
    {
        $this->orderId = $orderId;
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

    public static function findByOrderId($pdo, $order_id)
    {
        $sql = "SELECT product_id, quantity
                FROM order_item
                WHERE order_id=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $order_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}