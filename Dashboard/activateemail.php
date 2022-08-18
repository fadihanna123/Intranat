<?php ob_start(); ?>
<?php session_start(); ?>
<?php $title = "E-postverifiering"; ?>
<?php require "Includes/header.php"; ?>
<!-- Verifieringsdel -->
<div class="container-fluid">
    <div class="mymain">

        <h1>Verifiera e-postadress</h1>
  <?php
  $getkey = $_GET['key'];
  $getuid = $_GET['uid'];
  $getepost = $_GET['epost'];
  $functions = new Functions();
  if (isset($getkey) && isset($getuid) && isset($getepost)) {
      // Om det finns aktiveringnyckel, användareid, e-postadress i adressfältet.
      $functions->checkEmailKey($getkey, $getuid, $getepost);
  }
  // Slut om det finns aktiveringnyckel, användareid, e-postadress i adressfältet.
  else {
      // Om det saknas aktiveringsnyckel i adressfältet.
      echo "<div class='alert alert-danger'>
                Verifiering lyckades inte.<br />
                Du måste kontakta administratören.
            </div>";
  }

// Slut det saknas aktiveringsnyckel i adressfältet.
?>
  </div>
</div>
<?php require "Includes/footer.php"; ?>