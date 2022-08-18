<?php

error_reporting(-1);
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

spl_autoload_register(function ($class) {
    include 'Classes/' . $class . '.class.php';
});

define("DB_HOST", "localhost");
define("DB_USRNAME", "root");
define("DB_PSW", "");
define("DB_NAME", "");