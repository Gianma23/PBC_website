<?php
const CONNECTION = "mysql:host=localhost;dbname=pweb_615710";
const USER = "root";
const PASSWORD = "root";

$errorLogin = "";
$errorRegister = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["action"]) && $_POST["action"] == "login") {
        login();
    }
    else if(isset($_POST["action"]) && $_POST["action"] == "register") {
        register();
    }
}

function login() {

    global $errorLogin;
    $email = $password = "";
    if(isset($_POST["email"]) && isset($_POST["password"])) {
        if(validateInputs()) {
            $email = $_POST["email"];
            $password = $_POST["password"];
        }
    }

    try {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM account WHERE email=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();

        $account = $stmt->fetch();
        if(isset($account) && !empty($account)) {
            if(password_verify($password, $account["password"]))
                redirectToDashboard();
            else
                $errorLogin =  "<small class=\"error\">Password errata.</small>";
        }
        else
            $errorLogin =  "<small class=\"error\">Nessun account esistente con questa email!</small>";

        $pdo = null;
    }
    catch (PDOException $e) {
        $errorLogin =  "<small class=\"error\">Siamo spiacenti, il servizio non è raggiungibile.</small>";
        $pdo = null;
    }
}

function register() {

    global $errorRegister;
    $email = $password = "";
    if(isset($_POST["email"]) && isset($_POST["password"])) {
        if(validateInputs()) {
            $email = $_POST["email"];
            $password = $_POST["password"];
        }
    }

    try {
        $pdo = new PDO(CONNECTION, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM account WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();

        $account = $stmt->fetch();
        if(isset($account) && !empty($account)) {
            $errorRegister =  "<small class=\"error\">Email già registrata!</small>";
        }
        else {
            $sql = "INSERT INTO account (email, password) VALUES (?,?);";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, password_hash($password, PASSWORD_BCRYPT));
            $stmt->execute();

            redirectToDashboard();
        }
        $pdo = null;
    }
    catch (PDOException $e) {
        $errorRegister =  "<small class=\"error\">Siamo spiacenti, il servizio non è raggiungibile.</small>";
        $pdo = null;
    }
}

function validateInputs() {
    return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/", trim($_POST["password"])) &&
           preg_match("/^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/", trim($_POST["email"]));
}

function redirectToDashboard() {
    $host = $_SERVER["HTTP_HOST"];
    $current_directory = rtrim(dirname($_SERVER["PHP_SELF"]), "/");
    header("Location: http://$host/$current_directory/dashboard.php");
}
