<?php session_start(); ?>
<?php require("Includes/config.php"); ?>
<!DOCTYPE html>
<html lang="sv">
<head>
  <meta charset="UTF-8" />
  <script src="./ckeditor5/build/ckeditor.js"></script>
  <script src="./Js/main.js?t=<?= time(); ?>"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./CSS/main.css?t=<?= time(); ?>" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="apple-touch-icon" sizes="180x180" href="./Images/Favicon/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="./Images/Favicon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="./Images/Favicon/favicon-16x16.png" />
  <meta name="msapplication-TileColor" content="#da532c" />
  <meta name="theme-color" content="#ffffff" />
  <title>Intranätetet - <?= $title ?></title>
</head>
<body>
<?php 

      $dashboard = new Dashboard();
      $getimg = $dashboard->getLogoImg();
      // Logotypensdel.
      echo "<div class='container-fluid'>
          <nav class='navbar header bg-light navbar-dark'>
            <a class='navbar-brand' href='index.php'>
              <img src='$getimg' class='img-fluid w-sm-100' id='logobild' alt='Logotypen' />
            </a>
              ";

  ?>
    
<?php

       if (isset($_SESSION['loginuname']))
       { // Om man är inloggad.
          $dashboard = new Dashboard();
          // Navigeringsmeny.
          echo '<div class="ml-auto mr-4 inloggad">Inloggad som: ' . $dashboard->getFullName($_SESSION['loginuname']) . '
          </div>  
            
            <div class="justify-content-end" id="navmeny">
              <ul class="navbar-nav text-dark">
                <li class="nav-item">
                  <form action="./logout.php">
                    <button class="btn btn-danger logoutbtn text-light btn-lg">
                        Logga ut
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </nav>
          </div>
        ';
       } // Slut om man är inloggad.
       else
       { // Om man inte är inloggad.
         header("location: ../login.php?msg=true");
       } // Slut om man inte är inloggad.

?>