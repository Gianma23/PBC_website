<?php
namespace Controllers;
include_once(ROOT_PATH . "/app/models/Account.php");
include_once(ROOT_PATH . "/core/Validator.php");

use Ecommerce\Validator;
use Models\Account;
use PDO;

class AuthController
{
    public function login()
    {
        header('Content-Type: application/json; charset=utf-8');
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->validateInputs())
        {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $pdo = new PDO(CONNECTION, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $account = Account::findByEmail($pdo, $email);

            if ($account) {
                if (password_verify($password, $account["password"])) {
                    session_regenerate_id();
                    $_SESSION["role"] = $account["role"];
                    $_SESSION["account_id"] = $account["email"];
                    $this->redirectToDashboard($account["role"]);
                } else
                    echo json_encode(array('success' => false, 'text' => 'Password errata.'));
            }
            else
            {
                echo json_encode(array('success' => false, 'text' => 'Nessun account esistente con questa email!'));
            }
        }
    }

    public function register()
    {
        header('Content-Type: application/json; charset=utf-8');
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->validateInputs())
        {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $pdo = new PDO(CONNECTION, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $account = Account::findByEmail($pdo, $email);

            if(isset($account) && !empty($account))
            {
                echo json_encode(array('success' => false, 'text' => 'Email già registrata!'));
            }
            else
            {
                Account::add($pdo, $email, $password);
                session_regenerate_id();
                $_SESSION["role"] = "user";
                $_SESSION["account_id"] = $email;
                $this->redirectToDashboard("user");
            }
        }
    }

    public function logout()
    {
        header('Content-Type: application/json; charset=utf-8');
        if(isset($_SESSION['account_id']))
        {
            unset($_SESSION['account_id']);
            unset($_SESSION['role']);
            unset($_SESSION['cart']);
            echo json_encode(array('success' => true, 'text' => URL_ROOT . '/home'));
            exit();
        }
        else echo json_encode(array('success' => false, 'text' => 'Nessun account loggato.'));
    }

    /* ========================= FUNZIONI DI UTILITA ========================= */

    private function validateInputs()
    {
        if(isset($_POST["email"]) && isset($_POST["password"]))
        {
            $isEmailValid = Validator::validateEmail($_POST["email"]);
            $isPassValid = Validator::validatePassword($_POST["password"]);

            if($isEmailValid && $isPassValid)
                return true;
        }
        return false;
    }

    private function redirectToDashboard($account): void
    {
        unset($_SESSION['cart']);

        if($account == "user")
            echo json_encode(array('success' => true, 'text' => URL_ROOT . '/user-dashboard'));
        else if($account == "admin")
            echo json_encode(array('success' => true, 'text' => URL_ROOT . '/admin-dashboard'));
        exit();
    }
}