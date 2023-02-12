<?php
namespace Models;
use JsonSerializable;

class Order implements JsonSerializable
{
    protected $id;
    protected $accountId;
    protected $email;
    protected $shippingAddressId;
    protected $paymentType;
    protected $status;
    protected $shipmentTotal;
    protected $total;


    public function __construct($record)
    {
        $this->id = $record['id'];
        $this->accountId = $record['account_id'];
        $this->email = $record['email'];
        $this->shippingAddressId = $record['shipping_address_id'];
        $this->paymentType = $record['payment_type'];
        $this->status = $record['status'];
        $this->shipmentTotal = $record['shipment_total'];
        $this->total = $record['total'];
    }

    /* GETTERS & SETTERS */

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

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getShippingAddressId(){
        return $this->shippingAddressId;
    }

    public function setShippingAddressId($shippingAddressId){
        $this->shippingAddressId = $shippingAddressId;
    }

    public function getPaymentType(){
        return $this->paymentType;
    }

    public function setPaymentType($paymentType){
        $this->paymentType = $paymentType;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getShipmentTotal(){
        return $this->shipmentTotal;
    }

    public function setShipmentTotal($shipmentTotal){
        $this->shipmentTotal = $shipmentTotal;
    }

    public function getTotal(){
        return $this->total;
    }

    public function setTotal($total){
        $this->total = $total;
    }

    public static function add($pdo, $accountId, $email, $shippingAddressId, $paymentType, $shipmentTotal, $total)
    {
        $sql = "INSERT INTO `order` (account_id, email, shipping_address_id, payment_type, shipment_total, total)
                VALUES (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $accountId);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $shippingAddressId);
        $stmt->bindValue(4, $paymentType);
        $stmt->bindValue(5, $shipmentTotal);
        $stmt->bindValue(6, $total);
        $stmt->execute();

        return $pdo->lastInsertId();
    }

    public static function findAll($pdo)
    {
        $sql = "SELECT *
                FROM `order`";
        $result = $pdo->query($sql);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findById($pdo, $id)
    {
        $sql = "SELECT *
                FROM `order` 
                      INNER JOIN
                      address a on `order`.shipping_address_id = a.id
                WHERE `order`.id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function findByAccountIdFromTo($pdo, $accountId, $start, $number)
    {
        $sql = "SELECT *
                FROM `order`
                WHERE account_id = ?
                LIMIT ?,?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $accountId);
        $stmt->bindValue(2, $start, \PDO::PARAM_INT);
        $stmt->bindValue(3, $number, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findFromTo($pdo, $start, $number)
    {
        $sql = "SELECT *
                FROM `order`
                LIMIT ?,?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $start, \PDO::PARAM_INT);
        $stmt->bindValue(2, $number, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getCount($pdo)
    {
        $sql = "SELECT COUNT(*)
                FROM `order`";
        $result = $pdo->query($sql);
        return $result->fetchColumn();
    }

    public static function updateStatus($pdo, $orderId, $status)
    {
        $sql = "UPDATE `order`
                SET status = ?
                WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $orderId);
        return $stmt->execute();
    }

    public function jsonSerialize(): array
    {
        return [ "id" => $this->id,
            "account_id" => $this->accountId,
            "email" => $this->email,
            "status" => $this->status,
            "total" => $this->total];
    }
}