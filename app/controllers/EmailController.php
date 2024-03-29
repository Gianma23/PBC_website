<?php
namespace Controllers;
include_once(ROOT_PATH . "/core/Validator.php");

use Ecommerce\Validator;
use PDO;

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

        if(!Validator::validateEmail($email))
        {
            echo json_encode(array('success' => false, 'text' => 'Email non valida.'));
            return;
        }

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

    private function validateInputs()
    {
        if(isset($_POST['messaggio']) && isset($_POST['nome-cognome']) && isset($_POST['email']))
        {
            $messaggioValid = Validator::validateMessage($_POST['messaggio']) && Validator::validateLength($_POST['messaggio'], 200);
            $nomeCognomeValid = Validator::validateText($_POST['nome-cognome']);
            $emailValid = Validator::validateEmail($_POST['email']);

            if($messaggioValid && $nomeCognomeValid && $emailValid)
                return true;
        }
        return false;
    }
}