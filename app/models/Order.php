<?php
namespace Models;
use JsonSerializable;

class Order
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
}