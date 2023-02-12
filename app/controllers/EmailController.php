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
        header('Content-Type: application/json; charset=utf-8');
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']))
            $email = $_POST['email'];
        else
        {
            echo json_encode(array('success' => false, 'text' => 'Email non trovata'));
            return;
        }

        $this->validateInputs();

        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT *
                FROM newsletter
                WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        if($stmt->fetch())
        {
            echo json_encode(array('success' => false, 'text' => 'Email già iscritta!'));
            exit();
        }

        $sql = "INSERT INTO newsletter 
                VALUES (?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        echo json_encode(array('success' => true, 'text' => 'Iscritto con successo!'));
    }

    public function sendEmail()
    {
        header('Content-Type: application/json; charset=utf-8');
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipo']))
            $email = $_POST['tipo'];
        else
        {
            echo json_encode(array('success' => false, 'text' => 'Email non trovata'));
            return;
        }

        $this->validateInputs();

        if($email == 'rivenditore')
        {
            echo json_encode(array('success' => true, 'text' => 'Email inviata con successo!'));
        }
        else if($email == 'cliente')
        {
            echo json_encode(array('success' => true, 'text' => 'Email inviata con successo!'));
        }
        else
            echo json_encode(array('success' => false, 'text' => 'Email non valida'));
    }

    /* ========================= FUNZIONI DI UTILITA ========================= */

    //TODO validazione
    private function validateInputs()
    {

    }
}