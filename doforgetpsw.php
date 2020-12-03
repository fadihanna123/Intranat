<?php $title = "Återställa ett nytt lösenord"; ?>
<?php require "Includes/header.php"; ?>
<!-- Lösenordsåterställningsprocess -->
<div class="container text-center">
  <h1>Återställa ditt lösenord.</h1>
  <p>
    Här kan du skapa ett nytt lösenord.
  </p>
    <div class="container-fluid">
      <div id="doforgetpswmain">
  <?php
  $key = $_GET['key'];
  $uid = $_GET['uid'];
  if (isset($key) && isset($uid)) {
      // Om det finns återställningsnyckel i adressfältet.
      $forgetepswepost = strip_tags(
          htmlentities(
              isset($_POST['forgetepswepost']) ? $_POST['forgetepswepost'] : ""
          )
      );
      $forgetpsw = strip_tags(
          htmlentities(isset($_POST['forgetpsw']) ? $_POST['forgetpsw'] : "")
      );
      $confirmpsw = strip_tags(
          htmlentities(isset($_POST['confirmpsw']) ? $_POST['confirmpsw'] : "")
      );
      if (isset($_POST['doforgetpswbtn'])) {
          // Om man klickade på Återställa lösenordet.
          if (
              empty($forgetepswepost) ||
              empty($forgetpsw) ||
              empty($confirmpsw)
          ) {
              // Om man inte fyllde in samtliga obligatoriska fält.
              echo "<div class='alert alert-danger'>
                      Du behöver fylla in samtliga fält.
                     </div>";
          }
          // Slut om man inte fyllde in samtliga obligatoriska fält.
          else {
              // Om man fyllde in samtliga obligatoriska fält.
              if (filter_var($forgetepswepost, FILTER_VALIDATE_EMAIL)) {
                  // Om man fyllde in en korrekt e-postadress.
                  if (strlen($forgetpsw) >= 6 && strlen($confirmpsw) >= 6) {
                      // Om lösenordsfält har 6 tecken eller längre.
                      if ($forgetpsw == $confirmpsw) {
                          // Om både lösenordsfält matchades.
                          $functions->changepsw(
                              $key,
                              $uid,
                              $forgetepswepost,
                              $forgetpsw
                          );
                      }
                      // Slut om både lösenordsfält matchades.
                      else {
                          // Om både lösenordsfält inte matchades.
                          echo "<div class='alert alert-danger'>
                               Dina lösenordsfält matchas inte. <br />
                               Du behöver kontrollera både lösenordsfält.
                              </div>";
                      } // Slut om både lösenordsfält matchades.
                  }
                  // Slut om lösenordsfält har 6 tecken eller längre.
                  else {
                      // Om lösenordsfält har mindre än 6 tecken.
                      echo "<div class='alert alert-danger'>
                            Ditt lösenord måste ha minst 6 tecken.
                          </div>";
                  } // Slut om lösenordsfält har mindre än 6 tecken.
              }
              // Slut man fyllde in en korrekt e-postadress.
              else {
                  // Om man inte fyllde in en korrekt e-postadress.
                  echo "<div class='alert alert-danger'>
                        Du behöver fylla in en korrekt e-postadress.
                      </div>";
              } // Slut man inte fyllde in en korrekt e-postadress.
          } // Slut om man fyllde in samtliga obligatoriska fält.
      } // Slut om man klickade på Återställa lösenordet. // Lösenordsåterställningsformulär.
      echo "
          <div class='alert alert-info'>
            Samtliga fält är obligatoriska. <br />
            Observera att du måste ha minst 6 tecken i det utvalda lösenordet.
          </div>
          <div class='container mr-lg-1'>
            <form action='doforgetpsw.php?key=$key&uid=$uid' method='post' class='p-2 needs-validation myform' novalidate>
              <div class='row h-100 justify-content-center align-items-center'>
                <div class='form-group'>
                  <label for='forgetpsw'>Det nya lösenordet:*</label>
                    <input type='password' name='forgetpsw' id='forgetpsw' class='form-control forgetpsw' required />
                  </div>
               </div>

              <div class='row h-100 justify-content-center align-items-center'>
                <div class='form-group'>
                  <label for='confirmpsw'>Bekräfta det nya lösenordet:*</label>
                    <input type='password' name='confirmpsw' id='confirmpsw' class='form-control forgetpsw' required />
                </div>
              </div>
                <button class='btn btn-primary btn-lg' id='doforgetpswbtn' type='submit' name='doforgetpswbtn'>Återställa lösenordet</button>
            </form>
          </div>
        </div>
      ";
  }
  // Slut om det finns återställningsnyckel i adressfältet.
  else {
      // Om det saknas återställningsnyckel i adressfältet.
      echo "<div class='alert alert-danger'>
              Länken är ogiltig. Du måste kontakta administratören.
            </div>";
  }

// Slut det saknas återställningsnyckel i adressfältet.

?>
</div>
</div>
<?php require "Includes/footer.php"; ?>
