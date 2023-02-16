<?php
namespace Models;
use JsonSerializable;

include_once __DIR__ . "/Product.php";

class Cart
{
    private $id;
    private $accountId;

    function __construct($record, $pezzi)
    {
        $this->pezzi = $pezzi;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getAccountId(){
        return $this->accountId;
    }

    public function setAccountId($accountId){
        $this->accountId = $accountId;
    }

    /* ============= CRUD OPERATIONS ============= */

    public static function add($pdo, $account = null)
    {
        $sql = "INSERT INTO cart (id, account_id)
                VALUES (?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, session_id());
        $stmt->bindValue(2, $account);
        $stmt->execute();
        return session_id();
    }

    public static function findByAccountId($pdo, $account)
    {
        $sql = "SELECT * 
                FROM cart 
                WHERE account_id=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $account);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function findById($pdo, $id)
    {
        $sql = "SELECT * 
                FROM cart 
                WHERE id=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function delete($pdo, $id)
    {
        $sql = "DELETE FROM cart
                WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    public static function deleteByAccountId($pdo, $accountId)
    {
        $sql = "DELETE FROM cart
                WHERE account_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $accountId);
        return $stmt->execute();
    }
}