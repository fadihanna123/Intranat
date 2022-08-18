<?php session_start(); ?>
<?php $title = "Glömt lösenord?"; ?>
<?php require "Includes/header.php"; ?>



<div class="container text-center">
    <h2 class="rubrik">Återställa ditt lösenord</h2>
    <p>Här kan du återställa ditt lösenord.</p>
    <!-- Inloggningsmeddelande -->
    <div class="container-fluid">
      <div id="forgetpswmain">
      
      <?php
      
      if (isset($_SESSION['loginuname'])) {
          // Om användare är inloggad.
          header('location: ././dashboard.php');
      } // Slut om användare är inloggad.
      $forgetepost = strip_tags(
          htmlentities(
              isset($_POST["forgetepost"]) ? $_POST["forgetepost"] : ""
          )
      );
      if (isset($_POST['forgetpswbtn'])) {
          // Om användare klickade på Återställa lösenordet knappen.
          if (empty($forgetepost)) {
              // Om det saknas samtliga data för lösenordsåterställning.
              echo "<div class='alert alert-danger'>
                              Fyll in din e-postadress.
                        </div>";
          }
          // Slut om det saknas samtliga data för lösenordsåterställning.
          else {
              // Om det finns samtliga data för lösenordsåterställning.
              if (filter_var($forgetepost, FILTER_VALIDATE_EMAIL)) {
                  // Om e-postadress validerades korrekt.
                  $functions->forgetpsw($forgetepost);
              }
              // Slut om e-postadress validerades korrekt.
              else {
                  // Om e-postadress inte validerades korrekt.
                  echo "<div class='alert alert-danger'>
                              Fyll in en korrek e-postadress.
                    </div>";
              }
              // Slut om e-postadress inte validerades korrekt.
          } // Slut om det finns samtliga data för lösenordsåterställning.
      }

// Slut om användare klickade på Återställa lösenordet knappen.
?>

      
      </div>
  </div>
    <!-- Lösenordsåterställningsfrågansform -->
    <div class="container mr-lg-2">
      <form action="<?= $_SERVER[
          'PHP_SELF'
      ] ?>" method="post" class="p-2 myform needs-validation" novalidate>
      <div class="row h-100 justify-content-center align-items-center">
        <div class="form-group">
          <label for="forgetepost">E-postadress:</label>
          <input type="text" name="forgetepost" class="form-control" id="forgetepost" required />
        </div>
      </div>
          <button class="btn btn-primary btn-lg mx-auto" id="forgetpswbtn" type="submit" name="forgetpswbtn">Återställa lösenordet</button>
    </form>
    </div>
  </div>
  

  <?php require "Includes/footer.php"; ?>