<?php
namespace Ecommerce;

class Validator
{
    private function __construct(){}

    public static function validateText($text)
    {
        if (!self::isTextValid($text))
        {
            self::showError('Inserire un testo valido');
            exit();
        }  else {
            return true;
        }
    }

    public static function validateEmail($email)
    {
        if (!self::isEmailValid($email))
        {
            self::showError('Inserire una email valida.');
            exit();
        } else {
            return true;
        }
    }

    public static function validateMessage($message)
    {
        if (strlen($message) < 20)
        {
            self::showError('Il messaggio deve avere almeno 20 caratteri.');
            exit();
        } else {
            return true;
        }
    }

    public static function validatePassword($password)
    {
        if (!self::isPasswordValid($password))
        {
            self::showError('Includere almeno 8 caratteri, di cui almeno: 1 minuscolo, 1 maiuscolo, 1 numero');
            exit();
        } else {
            return true;
        }
    }

    public static function validateTelephone($telephone)
    {
        if (!self::isTelephoneValid($telephone))
        {
            self::showError('Numero di telefono non valido.');
            exit();
        } else {
            return true;
        }
    }

    public static function validateCap($cap)
    {
        if (!self::isCapValid($cap))
        {
            self::showError('Codice postale non valido.');
            exit();
        } else {
            return true;
        }
    }

    public static function validateLength($text, $length = 1000)
    {
        if (strlen($text) > $length)
        {
            self::showError('Il campo deve essere al massimo ' . $length . 'caratteri');
            exit();
        } else {
            return true;
        }
    }

    public static function validateNatural($number)
    {
        if($number < 0)
        {
            self::showError('Inserire un numero positivo.');
            exit();
        } else {
            return true;
        }
    }

    public static function validateImage($image)
    {
        $allowed = array('gif', 'png', 'jpg');
        $filename = $image['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if(!in_array($ext, $allowed))
        {
            self::showError('Inserire il file di un\'immagine.');
            exit();
        } else {
            return true;
        }
    }

    /* Funzioni booleane di utilità */

    private static function isTextValid($text)
    {
        $re = '/([a-z]+)(\s*)+/';
        return preg_match($re, $text);
    }

    private static function isEmailValid($email)
    {
        $re = '/^((?!\.)[\w.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/';
        return preg_match($re, $email);
    }

    private static function isPasswordValid($password)
    {
        $re = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/';
        return preg_match($re, $password);
    }

    private static function isTelephoneValid($telephone)
    {
        $re = '/^(\((00|\+)39\)|(00|\+)39)?(38[890]|34[4-90]|36[680]|33[13-90]|32[89]|35[01]|37[019])(\s?\d{3}\s?\d{3,4}|\d{6,7})$/';
        return preg_match($re, $telephone);
    }

    private static function isCapValid($cap)
    {
        $re = '/^[0-9]{5}$/';
        return preg_match($re, $cap);
    }

    /* Mostra messaggio di errore */

    private static function showError($message)
    {
        echo json_encode(array('success' => false, 'text' => $message));
    }
}