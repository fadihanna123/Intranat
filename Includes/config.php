<?php

error_reporting(-1);
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);

spl_autoload_register(function ($class) {
  include 'Classes/' . $class . '.class.php';
});

define("DB_HOST", "localhost");
define("DB_USRNAME", "root");
define("DB_PSW", "0000");
define("DB_NAME", "intranat");
