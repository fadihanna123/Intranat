<?php $title = "FAQ"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>

  <div class="container-fluid">
    <div id="main" class="mymain">
        <!-- FAQdel -->
        <div class="container-fluid">
        <?php if (isset($_SESSION['loginuname'])) {
    // Om man är inloggad.
    if ($dashboard->checkadminuser($_SESSION['loginuname']) == "1") {
        // Om användaren har administratörensbehörigheter.
        if (isset($_POST['addFAQbtn'])) {
            // Om användare klickade på Lägg till knappen.
            $addquestion = strip_tags(
                htmlentities(
                    isset($_POST['addquestion'])
                                ? $_POST['addquestion']
                                : ""
                )
            );
            $addanswer = html_entity_decode(
                isset($_POST['addanswer']) ? $_POST['addanswer'] : ""
            );
            if (empty($addquestion) || empty($addanswer)) {
                // Om man inte fyllde in alla obligatoriska fält.
                echo "<div class='alert alert-danger'>
                                        Du behöver fylla in alla fält.
                                  </div>";
            }
            // Slut om man inte fyllde in alla obligatoriska fält.
            else {
                // Om man fyllde in alla fält.
                $dashboard->AddFAQ($addquestion, $addanswer);
            } // Om man fyllde in alla fält.
        }
        // Slut om användare klickade på Lägg till knappen.
        echo "
                    <div class='container-fluid'>
                      <div class='row'>
                        <div class='col-sm-10'>
                          <img src='Images/Ikoner/add-1.png' alt='Lägga till ikon' class='img-fluid addicon' />
                          <h1 class='ml-4'>Lägg till frågor</h1>
                          <div class='alert alert-info'>
                              Alla fält är obligatoriska.
                          </div>
                            <form action='FAQ.php' method='post'>
                              <div class='row'>
                                <div class='form-group col-md-7'>
                                    <label for='addquestion'>Fråga:*</label>
                                      <input type='text' name='addquestion' class='form-control' id='addquestion' required />
                                </div>
                              </div>

                              <div class='row'>
                                <div class='form-group col-md-7'>
                                    <label for='addanswer'>Svar:*</label>
                                      <textarea name='addanswer' id='addanswer'></textarea>
                                </div>
                              </div>

                              <div class='row'>
                                <div class='col-md-7 mx-auto'>
                                    <input class='btn btn-primary btn-lg mb-1 addFAQbtn' name='addFAQbtn' type='submit' value='Lägg till' />
                                </div>
                              </div>


                            </form>
                        </div>
                      </div>
                    </div>
                
                    
                    ";
    }
    // Slut om användaren har administratörensbehörigheter.
    $dashboard->GetFAQ();
}
        // Slut om man är inloggad.
        else {
            // Om man inte är inloggad.
            header("location: ../login.php?msg=true");
        }
// Slut om man inte är inloggad.
?>


<script>
    // CKeditor inställningar.
        ClassicEditor
    .create( document.querySelector( '#addanswer' ), {
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
        console.log( error );
    } );
   
    </script>
<?php require "Includes/footer.php"; ?>