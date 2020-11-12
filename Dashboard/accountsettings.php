<?php ob_start(); ?>
<?php session_start(); ?>
<?php $title = "Mitt konto"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>

  <div class="container-fluid">
    <div class="mymain">
    
    <?php
    $editusername = strip_tags(
        htmlentities(
            isset($_POST['editusername']) ? $_POST['editusername'] : ""
        )
    );
    $editfullname = strip_tags(
        htmlentities(
            isset($_POST['editfullname']) ? $_POST['editfullname'] : ""
        )
    );
    $editaddressstreet = strip_tags(
        htmlentities(
            isset($_POST['editaddressstreet'])
                ? $_POST['editaddressstreet']
                : ""
        )
    );
    $editaddressbox = strip_tags(
        htmlentities(
            isset($_POST['editaddressbox']) ? $_POST['editaddressbox'] : ""
        )
    );
    $editaddresscity = strip_tags(
        htmlentities(
            isset($_POST["editaddresscity"]) ? $_POST["editaddresscity"] : ""
        )
    );
    $editmobnr = strip_tags(
        htmlentities(isset($_POST["editmobnr"]) ? $_POST["editmobnr"] : "")
    );
    $edittfnr = strip_tags(
        htmlentities(isset($_POST["edittfnr"]) ? $_POST["edittfnr"] : "")
    );
    $editavatar = isset($_FILES["editavatar"]['name'])
        ? $_FILES["editavatar"]['name']
        : "";
    $filetype = isset($_FILES["editavatar"]['type'])
        ? $_FILES["editavatar"]['type']
        : "";
    $tmpname = isset($_FILES["editavatar"]['tmp_name'])
        ? $_FILES["editavatar"]['tmp_name']
        : "";
    $editepost = strip_tags(
        htmlentities(isset($_POST["editepost"]) ? $_POST["editepost"] : "")
    );
    $editconfirmepost = strip_tags(
        htmlentities(
            isset($_POST["editconfirmepost"]) ? $_POST["editconfirmepost"] : ""
        )
    );
    $editpsw = strip_tags(
        htmlentities(isset($_POST["editpsw"]) ? $_POST["editpsw"] : "")
    );
    $editconfirmpsw = strip_tags(
        htmlentities(
            isset($_POST["editconfirmpsw"]) ? $_POST["editconfirmpsw"] : ""
        )
    );
    $editadminmange = strip_tags(
        htmlentities(
            isset($_POST["editadminmange"]) ? $_POST["editadminmange"] : ""
        )
    );
    if (isset($_SESSION['loginuname'])) {
        // Om man är inloggad.

        if (isset($_POST['editaccountbtn'])) {
            // Om användare klickade på Uppdatera knappen.
            if (
                isset($editavatar) &&
                ($filetype =
                    "image/jpg" &&
                    ($filetype =
                        "image/png" &&
                        ($filetype =
                            "image/jpeg" && ($filetype = "image/gif"))))
            ) {
                // Om användare bifogade bildfil och bildtyper var jpg, png, jpeg och gif.
                if (
                    move_uploaded_file($tmpname, "./Images/Users/$editavatar")
                ) {
                    // Om bildfilen överfördes till Users mappen.
                    $bild = "Images/Users/$editavatar";
                    copy($bild, "./Images/Users/" . $editavatar);
                } // Slut om bildfilen överfördes till Users mappen.
            } // Slut om bildtyper var jpg, png, jpeg och gif.
            $dashboard->UpdateAccountSettings(
                $editusername,
                $editfullname,
                $editaddressstreet,
                $editaddressbox,
                $editaddresscity,
                $editmobnr,
                $edittfnr,
                isset($bild) ? $bild : ""
            );
        } // Slut om användare klickade på Uppdatera knappen.
        if (isset($_POST['editepostbtn'])) {
            // Om användare klickade på Ändra knappen.
            $editepost = strip_tags(
                htmlentities(
                    isset($_POST['editepost']) ? $_POST['editepost'] : ""
                )
            );
            $editconfirmepost = strip_tags(
                htmlentities(
                    isset($_POST['editconfirmepost'])
                        ? $_POST['editconfirmepost']
                        : ""
                )
            );
            if (empty($editepost) || empty($editconfirmepost)) {
                // Om man inte fyllde in alla obligatoriska fält.
                echo "<div class='alert alert-danger'>
                              Du behöver fylla in alla obligatoriska fält.<br />
                              Fyll in alla obligatoriska fält.
                            </div>";
            }
            // Slut om man inte fyllde in alla obligatoriska fält.
            else {
                // Om man fyllde in alla obligatoriska fält.
                if ($editepost == $editconfirmepost) {
                    // Om både e-postadress och det upprepade e-postadressen fälten matchas.
                    if (filter_var($editepost, FILTER_VALIDATE_EMAIL)) {
                        // Om e-postadressen validerades korrekt.
                        $dashboard->SendEmailActivate($editepost);
                    }
                    // Slut om e-postadressen validerades korrekt.
                    else {
                        // Om e-postadressen inte validerades korrekt.
                        echo "<div class='alert alert-danger'>
                                      Du fyllde in inkorrekt e-postadress. <br />
                                      Fyll in en korrekt e-postadress.
                                    </div>";
                    } // Slut om e-postadressen inte validerades korrekt.
                }
                // Slut om både e-postadress och det upprepade e-postadressen fälten matchas.
                else {
                    // Om både e-postadress och det upprepade e-postadressen fälten inte matchas.
                    echo "<div class='alert alert-danger'>
                                    Ditt e-postadress och det upprepade e-postadress fältet matchas inte.
                                </div>";
                } // Slut om både e-postadress och det upprepade e-postadressen fälten inte matchas.
            }

            // Om man fyllde in alla obligatoriska fält.
        } // Slut om användare klickade på Ändra knappen.
        if (isset($_POST['editpswbtn'])) {
            // Om användare klickade på Ändra knappen.
            $editpsw = strip_tags(
                htmlentities(isset($_POST['editpsw']) ? $_POST['editpsw'] : "")
            );
            $editconfirmpsw = strip_tags(
                htmlentities(
                    isset($_POST['editconfirmpsw'])
                        ? $_POST['editconfirmpsw']
                        : ""
                )
            );
            if (empty($editpsw) || empty($editpsw)) {
                // Om man inte fyllde in alla obligatoriska fält.
                echo "<div class='alert alert-danger'>
                              Du behöver fylla in alla obligatoriska fält.<br />
                              Fyll in alla obligatoriska fält!
                            </div>";
            }
            // Slut om man inte fyllde in alla obligatoriska fält.
            else {
                // Om man fyllde in alla obligatoriska fält.
                if ($editpsw == $editconfirmpsw) {
                    // Om både lösenord och det upprepade lösenordetfälten matchas.
                    if (strlen($editpsw) >= 6) {
                        // Om lösenordets tecken var längre än 6 tecken eller lika med 6 tecken.
                        $dashboard->UpdatePsw($editpsw);
                    }
                    // Slut om lösenordets tecken var längre än 6 tecken eller lika med 6 tecken.
                    else {
                        // Om lösenordets tecken var mindre än 6 tecken eller lika med 6 tecken.
                        echo "<div class='alert alert-danger'>
                                      Ditt lösenord måste vara minst 6 tecken.
                                  </div>";
                    } // Om lösenordets tecken var mindre än 6 tecken eller lika med 6 tecken.
                }
                // Slut om både lösenord och det upprepade lösenordet fälten matchas.
                else {
                    // Om både e-postadress och det upprepade lösenordet fälten inte matchas.
                    echo "<div class='alert alert-danger'>
                                    Ditt lösenord och det upprepade lösenord fältet matchas inte.
                                </div>";
                } // Slut om både e-postadress och det upprepade lösenordet fälten inte matchas.
            } // Om man fyllde in alla obligatoriska fält.
        } // Slut om användare klickade på Ändra knappen.
        // Mitt konto- och e-postadressändrings formulär.
        echo "
                    <div class='container-fluid'>
                       <div class='row'>     
                        <div class='col-sm-6'>";
        $dashboard->GetAccountSettingsForm();
        echo "</div>
                            <div class='col'>";
        $dashboard->GetEmailSettingsForm();
        echo "</div>  </div>"; // Lösenordsändringsformulär.
        echo "<div class='col-sm-5'>
                    <img src='Images/Ikoner/lock.png' class='pswicon img-fluid' alt='Lösenordsändringsikon' />
                        <h2 class='rubrik specrubriktxt'>Ändra lösenord</h2>
                          <p class='specrubriktxt' style='z-index: 100;'>
                            Här kan du ändra ditt lösenord.<br />
                            Observera att det nya utvalda lösenordet måste vara minst 6 tecken.
                          </p>
                          
                <form action='accountsettings.php' class='needs-validation' novalidate method='post'>
                    
                    
                    <div class='row'>
                        <label for='editpsw' class='col-sm-4 ml-3 mt-3'>Nytt lösenord:*</label>
                          <div class='col-sm-5'>
                            <input type='password' name='editpsw' class='ml-1 form-control' id='editpsw' required />
                          </div>
                    </div>
                      <br />
                      <div class='row'>
                          <label for='editconfirmpsw' class='ml-3 mt-3 col-sm-4'>Bekräfta lösenord:*</label>
                            <div class='col-sm-5'>
                              <input type='password' class='form-control ml-1' name='editconfirmpsw' id='editconfirmpsw' required />
                            </div>
                      </div>

                      <br />
                  <div class='row'>
                      <div class='col-sm-5'>
                        <input type='checkbox' class='ml-3' onclick='showPsw()' id='showpsw' name='showpsw' /> Visa lösenordet
                      </div>    
                  </div>
                  <div class='row'>
                        <div class='mx-auto'>
                          <input class='btn btn-primary ml-4 mb-2 btn-lg' name='editpswbtn' id='editpswbtn' type='submit' value='Ändra' />
                        </div>
                   </div>

                    
                </form>
                </div>
               ";
    }
    // Slut om man är inloggad.
    else {
        // Om man inte är inloggad.
        header("location: ../login.php?msg=true");
    }

// Slut om man inte är inloggad.
?>
    <script>
             // Den styr om lösenordet ska visas eller intei lösenordsändringsformulär.   
            function showPsw() 
            {
              let x = document.getElementById("editpsw");
              if (x.type === "password") 
              { // Om typen för fältet är password.
                x.type = "text";
              } // Slut om typen för fältet är password.
              else 
              { // Om typen för fältet är text.
                x.type = "password";
              } // Slut om typen för fältet är text.
            }
  
    </script>
      </div>
    </div>
</div>
  <?php require "Includes/footer.php"; ?>
           
