<?php $title = "Kontoverifiering"; ?>
<?php require "Includes/header.php"; ?>
<!-- Kontoaktiveringsprocess -->
<div class="container text-center">
  <h1 class="display-4">Verifiera ditt konto</h1>
  <?php if (isset($_GET['key'])) {
      // Om det finns aktiveringsnyckel i adressfältet.
      $functions->checkkey($_GET['key'], $_GET['uid']);
  }
  // Slut om det finns aktiveringsnyckel i adressfältet.
  else {
      // Om det saknas aktiveringsnyckel i adressfältet.
      echo "<div class='alert alert-danger'>
              Kontoverifiering lyckades inte.<br /> 
              Du måste kontakta administratören.
            </div>";
  }
// Slut det saknas aktiveringsnyckel i adressfältet.
?>
</div>

<?php require "Includes/footer.php"; ?>
