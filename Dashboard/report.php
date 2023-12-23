<?php ob_start(); ?>
<?php session_start(); ?>
<?php $title = "Anmälan"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>

  <div class="container-fluid">
    <div class="mymain">
    <?php
    $sickreason = html_entity_decode(
    isset($_POST["sickreason"]) ? $_POST["sickreason"] : ""
);
    $sickfrom = strip_tags(
        htmlentities(isset($_POST["sickfrom"]) ? $_POST["sickfrom"] : "")
    );
    $sickto = strip_tags(
        htmlentities(isset($_POST["sickto"]) ? $_POST["sickto"] : "")
    );
    $leavereason = html_entity_decode(
        isset($_POST["leavereason"]) ? $_POST["leavereason"] : ""
    );
    $leavefrom = strip_tags(
        htmlentities(isset($_POST["leavefrom"]) ? $_POST["leavefrom"] : "")
    );
    $leaveto = strip_tags(
        htmlentities(isset($_POST["leaveto"]) ? $_POST["leaveto"] : "")
    );
    if (isset($_SESSION['loginuname'])) {
        // Om man är inloggad.
        if (isset($_POST['sendsickrequest'])) {
            // Om användare klickade på Sjukanmäla sig knappen.
            if (empty($sickreason) || empty($sickfrom)) {
                // Om det saknas värde i obligatoriska fält.
                echo "<div class='alert alert-danger'>
                              Du behöver fylla in de obligatoriska fält.
                        </div>";
            }
            // Slut om det saknas värde i obligatoriska fält.
            else {
                // Om det finns värde i samtliga fält.
                $dashboard->SendSickRequest($sickreason, $sickfrom, $sickto);
            }

            // Slut om det finns värde i samtliga fält.
        }
        // Slut om användare klickade på Sjukanmäla sig knappen.
        if (isset($_POST['sendleaverequest'])) {
            // Om användare klickade på Anmäla knappen.
            if (empty($leavereason) || empty($leavefrom)) {
                // Om det saknas värde i obligatoriska fält.
                echo "<div class='alert alert-danger'>
                                  Du behöver fylla in de obligatoriska fält.
                            </div>";
            }
            // Slut om det saknas värde i obligatoriska fält.
            else {
                // Om det finns värde i samtliga fält.

                $dashboard->SendLeaveRequest(
                    $leavereason,
                    $leavefrom,
                    $leaveto
                );
            }
            // Slut om det finns värde i samtliga fält.
        } // Slut om användare klickade på Anmäla knappen.
        echo '<div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                      <img src="Images/Ikoner/add-1.png" class="img-fluid ml-1 specheadicon" alt="Lägg till nyhet ikonen" />
                        <h2 class="rubrik ml-5">Sjukanmälan</h2>
                          <p class="ml-1">
                            Här kan du sjukanmäla dig.
                          </p>'; // Sjukanmälans formulär.
        echo "
              <form action='report.php' method='post'>   
                <div class='row'>
                  <div class='form-group col-md-9'>
                    <label for='sickreason' class='ml-3'>Anledning:*</label>
                      <textarea name='sickreason' class='form-control report' id='sickreason'></textarea>
                </div>
              </div>
              
              <div class='row'>
                <div class='form-group col-md-9'>
                  <label for='sickfrom' class='ml-3'>Från:*</label>
                      <input type='date' class='form-control' name='sickfrom' id='sickfrom' required />
                </div>
              </div>

              <div class='row'>
              <div class='form-group col-md-9'>
                  <label for='sickto' class='ml-3'>Till:</label>
                        <input type='date' class='form-control' name='sickto' id='sickto' />
                  </div>
                </div>

                
                <div class='row'>
                  <div class='col-md-3 mr-5 col-md-offset-4 text-center'>
                    <input class='btn btn-primary btn-lg' name='sendsickrequest' id='sendsickrequest' type='submit' value='Sjukanmäla sig' />
                  </div>
                </div>
              </form>
              </div>"; // Ledighetsansökan.
        echo '
            <div class="col-md-6">
              <img src="Images/Ikoner/register.png" class="img-fluid leaveicon" alt="Anmälanikon" />
                <h2 class="ml-5 rubrik mt-2">Ledighetsansökan</h2>
                    <p class="spec">
                      Här kan du söka om ledighet.
                    </p>
                      <form action="report.php" method="post">
                        <div class="row">
                          <div class="form-group col-md-9">
                            <label for="leavereason" class="ml-3">Anledning:*</label>
                              <textarea name="leavereason" class="form-control report" id="leavereason"></textarea>
                          </div>
                        </div>
                      
                          <div class="row">
                            <div class="form-group col-md-9">
                              <label for="leavefrom" class="ml-3">Från:*</label>
                                <input type="date" class="form-control" name="leavefrom" id="leavefrom" required />
                            </div>
                      </div>

                            <div class="row">
                                    <div class="form-group col-md-9">
                                        <label for="leaveto" class="ml-3">Till:</label>
                                              <input type="date" class="form-control" name="leaveto" id="leaveto" />
                                        </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-md-4 mr-5 col-md-offset-4 text-center">
                                              <input class="btn btn-primary btn-lg" name="sendleaverequest" id="sendleaverequest" type="submit" value="Anmäla" />
                                          </div>
                                      </div>
                        </form>
                </div>

            ';
    }
    // Slut om man är inloggad.
    else {
        // Om man inte är inloggad.
        header("location: ../login.php?msg=true");
    }

// Slut om man inte är inloggad.
?>


<script>
    // Ckeditor inställningar.
    ClassicEditor
    .create( document.querySelector( '#sickreason' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    } )
    .catch( error => {
        console.error(`❌ ${error}`);
    } );



    // Ckeditor inställningar.
    ClassicEditor
    .create( document.querySelector( '#leavereason' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    } )
    .catch( error => {
        console.error(`❌ ${error}`);
    } );
    
  </script>
  </div></div></div></div>
  <?php require "Includes/footer.php"; ?>
           