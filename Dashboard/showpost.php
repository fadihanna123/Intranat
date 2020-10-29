<?php ob_start(); ?>
<?php $title = "Visa nyhetsinlägg"; ?>
<?php require("Includes/header.php"); ?>
<?php require("Includes/nav.php"); ?>

  <div class="container-fluid">
    <div id="main" class="mymain">
  
    

<!-- Nyhetersdelen -->  
<div class="container-fluid">
  
    <?php
     if (isset($_SESSION['loginuname']))
     { // Om man är inloggad.
       
        if (isset($_GET['id']))
        { // Om adressfältet har rätt id.

          $dashboard->showFullContent($_GET['id']);
        } // Slut om adressfältet har rätt id.
        else
        { // Om adressfältet saknar rätt id.
          header("location: index.php");
          exit();
        } // Slut om adressfältet saknar rätt id.

    } // Slut om man är inloggad.
     else
     { // Om man inte är inloggad.
       header("location: ../login.php?msg=true");
     } // Om man inte är inloggad.
    ?>
    </div>
   </div>
<?php require "Includes/footer.php"; ?>

