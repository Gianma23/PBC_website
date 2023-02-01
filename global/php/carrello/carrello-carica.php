<?php
include_once "global/php/utils/DBUtils.php";


$prodotti = isset($_SESSION["cart"]) ? $_SESSION["cart"] : array();

foreach($prodotti as $key => $value) {
    echo "<p>$key quantità: $value</p>";
}

