<?php
namespace Models;
use JsonSerializable;

class Address
{
    protected $id;
    protected $name;
    protected $surname;
    protected $street;
    protected $province;
    protected $city;
    protected $cap;
    protected $telephone;
    protected $note;


    public function __construct($record)
    {
        $this->id = $record['id'];
        $this->name = $record['name'];
        $this->surname = $record['surname'];
        $this->street = $record['street'];
        $this->province = $record['province'];
        $this->city = $record['city'];
        $this->cap = $record['cap'];
        $this->telephone = $record['telephone'];
        $this->note = $record['note'];
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function setSurname($surname){
        $this->surname = $surname;
    }

    public function getStreet(){
        return $this->street;
    }

    public function setStreet($street){
        $this->street = $street;
    }

    public function getProvince(){
        return $this->province;
    }

    public function setProvince($province){
        $this->province = $province;
    }

    public function getCity(){
        return $this->city;
    }

    public function setCity($city){
        $this->city = $city;
    }

    public function getCap(){
        return $this->cap;
    }

    public function setCap($cap){
        $this->cap = $cap;
    }

    public function getTelephone(){
        return $this->telephone;
    }

    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }

    public function getNote(){
        return $this->note;
    }

    public function setNote($note){
        $this->note = $note;
    }

    public static function add($pdo, $name, $surname, $street, $province, $city, $cap, $telehpone, $note)
    {
        $sql = "INSERT INTO address (name, surname, street, province, city, cap, telephone, note)
                VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $surname);
        $stmt->bindValue(3, $street);
        $stmt->bindValue(4, $province);
        $stmt->bindValue(5, $city);
        $stmt->bindValue(6, $cap);
        $stmt->bindValue(7, $telehpone);
        $stmt->bindValue(8, $note);
        $stmt->execute();

        return $pdo->lastInsertId();
    }
}