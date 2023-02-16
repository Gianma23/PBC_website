<?php

define('ROOT_PATH', dirname(__FILE__,3));
define('ROOT_DIR', explode( '/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[1]);

const WEB_PATH = '/' . ROOT_DIR . '/public';
const URL_ROOT = 'http://localhost/' . ROOT_DIR;

// Database
const CONNECTION = "mysql:host=localhost:3306;dbname=saggini_615710";
const USER = "root";
const PASSWORD = "";