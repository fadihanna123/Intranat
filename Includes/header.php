<?php

require "config.php";
$functions = new Functions();
$getname = $functions->getCompanyName();
?>
<!DOCTYPE html>
<html lang="sv">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
  <link rel="stylesheet" href="./CSS/main.css?t=<?= time() ?>" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="./Js/main.js?t=<?= time() ?>"></script>
  <link rel="apple-touch-icon" sizes="180x180" href="./Images/Favicon/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="./Images/Favicon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="./Images/Favicon/favicon-16x16.png" />
  <meta name="msapplication-TileColor" content="#da532c" />
  <meta name="theme-color" content="#ffffff" />
  <title><?= $getname . " - " . $title ?></title>
</head>
<body>
  <div class="container-fluid">
    <nav class="navbar header navbar-expand-md bg-light navbar-dark">
      <!-- Logotypen --> 
      <a class="navbar-brand" href="index.php">
        <img src="<?php echo $functions->getLogoImg(); ?>" class="img-fluid" id="logobild" alt="Logotypen" />
      </a>

      <!-- Responsiv menyikon --> 
      <button class="navbar-toggler bg-info" type="button" data-toggle="collapse" data-target="#navmeny">
        <span class="navbar-toggler-icon"></span>
      </button>
    
        <!-- Navvigeringsmeny -->
        <div class="collapse navbar-collapse justify-content-end" id="navmeny">
          <ul class="navbar-nav text-dark">
            <li class="nav-item">
              <a class="nav-link text-dark font-weight-bold" href="login.php">
                <img class="img-fluid icon" alt="Inloggningsikon" src="Images/Ikoner/login.png" />Logga in
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark font-weight-bold" href="register.php">
                <img class="icon img-fluid" alt="Registreringsikon" src="Images/Ikoner/register.png" />Registrera dig
            </a>
            </li>
          
          </ul>
        </div>
      </nav>
      </div>

      



 