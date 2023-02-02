<?php
namespace Ecommerce;

spl_autoload_register(function($className) {
    // controller autoloading
    $filename =  str_replace('\\', DIRECTORY_SEPARATOR, $className) . ".php";
    if (file_exists($filename)) {
        echo $filename;
        require_once($filename);
        if (class_exists($className)) {
            return true;
        }
    }
    return true;

});