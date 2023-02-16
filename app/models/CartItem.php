<?php
namespace Models;

include_once __DIR__ . "/Product.php";

class CartItem
{
    private $cartId;
    private $productId;
    private $pezzi;

    function __construct($cartId, $productId, $pezzi = 1)
    {
        $this->cartId = $cartId;
        $this->productId = $productId;
        $this->pezzi = $pezzi;
    }

    public function getCartId(){
        return $this->cartId;
    }

    public function setCartId($cartId){
        $this->cartId = $cartId;
    }

    public function getPezzi(){
        return $this->pezzi;
    }

    public function setPezzi($pezzi){
        $this->pezzi = $pezzi;
    }

    public function getProductId(){
        return $this->productId;
    }

    public function setProductId($productId){
        $this->productId = $productId;
    }

    /* ============= CRUD OPERATIONS ============= */

    public static function add($pdo, $cart)
    {
        $sql = "INSERT INTO cart_item (cart_id, product_id, quantity)
                VALUE (?,?,1);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $cart->getCartId());
        $stmt->bindValue(2, $cart->getProductId());
        return $stmt->execute();
    }

    public static function updateByOne($pdo, $cart)
    {
        $sql = "UPDATE cart_item
                SET quantity = quantity + 1
                WHERE cart_id=? AND product_id=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $cart->getCartId());
        $stmt->bindValue(2, $cart->getProductId());
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

    public static function findByCartId($pdo, $cartId)
    {
        $sql = "SELECT product_id, quantity
                FROM cart_item
                WHERE cart_id=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $cartId);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function delete($pdo, $cartId, $productId)
    {
        $sql = "DELETE FROM cart_item
                WHERE cart_id = ? AND product_id = ?;";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(array($cartId,  $productId));
    }
}