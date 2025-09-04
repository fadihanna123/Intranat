<?php

error_reporting(-1);
ini_set("display_errors", 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
  include 'Classes/' . $class . '.class.php';
});

define("DB_HOST", "127.0.0.1");
define("DB_USRNAME", "fadi");
define("DB_PSW", "0000");
define("DB_NAME", "intranat");
