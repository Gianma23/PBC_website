<?php

namespace Models;

class Account
{
    private $email;
    private $password;

    public function __construct($record)
    {
        $this->email = $record['email'];
        $this->password = $record['password'];
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    /* ============= CRUD OPERATIONS ============= */

    public static function findByEmail($pdo, $email)
    {
        $sql = "SELECT * FROM account WHERE email=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function add($pdo, $email, $password)
    {
        $sql = "INSERT INTO account (email, password) VALUES (?,?);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->bindValue(2, password_hash($password, PASSWORD_BCRYPT));
        return $stmt->execute();
    }
}