<?php
namespace Controllers;

use Ecommerce\Render;
use Models\Product;
use Models\Beer;
use PDO;
use PDOException;

class EmailController
{
    public function addToNewsletter()
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST')


        json_encode(array('success' => true, 'text' => ''));
    }

    public function sendEmail($vars)
    {
        $email = $vars['email'];
        if($email == 'rivenditori')
        {

        }
        else if($email == 'clienti')
        {

        }
    }
}