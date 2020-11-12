<?php ob_start(); ?>
<?php session_start(); ?>
<?php $title = "Lägg till nyhetsinlägg"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>

<div class="container-fluid">
  <div id="main" class="mymain">
        <?php if (isset($_SESSION['loginuname'])) {
            // Om man är inloggad.
            if ($dashboard->checkadminuser($_SESSION['loginuname']) == 1) {
                // Om användaren har administratörsbehörigheter.
                echo '
                  <img src="Images/Ikoner/add-1.png" class="img-fluid headicon" alt="Lägg till nyhet ikonen" />
                    <h2 class="rubrik ml-5">Lägg till nyheter</h2>
                      <p class="ml-3">
                        Här kan du lägga till nyheter.
                      </p>

                      <div class="alert alert-info ml-2">
                        Alla fält är obligatoriska.
                      </div>
                  
                <div class="container-fluid">
                    <div id="addnewsmain">';
                $addtitle = strip_tags(
                    htmlentities(
                        isset($_POST["addtitle"]) ? $_POST["addtitle"] : ""
                    )
                );
                $addcat = strip_tags(
                    htmlentities(
                        isset($_POST["addcat"]) ? $_POST["addcat"] : ""
                    )
                );
                $addcontent = isset($_POST["addcontent"])
                    ? $_POST["addcontent"]
                    : "";
                $filename = isset($_FILES['addimg']['name'])
                    ? $_FILES['addimg']['name']
                    : "";
                $filetype = isset($_FILES['addimg']['type'])
                    ? $_FILES['addimg']['type']
                    : "";
                $tmpname = isset($_FILES['addimg']['tmp_name'])
                    ? $_FILES['addimg']['tmp_name']
                    : "";
                if (isset($_POST['addbtn'])) {
                    // Om användare klickade på Lägg till knappen.
                    if (
                        empty($addtitle) ||
                        empty($addcat) ||
                        empty($addcontent) ||
                        empty($filename)
                    ) {
                        // Om det saknas samtliga fält.
                        echo "<div class='alert alert-danger ml-2'>
                                Du behöver fylla in samtliga fält.
                          </div>";
                    }
                    // Slut om det saknas samtliga fält.
                    else {
                        // Om det finns samtliga fält.
                        if (
                            isset($filename) &&
                            ($filetype =
                                "image/jpg" &&
                                ($filetype =
                                    "image/png" &&
                                    ($filetype =
                                        "image/jpeg" &&
                                        ($filetype = "image/gif"))))
                        ) {
                            // Om användare bifogade bildfil och bildtyper var jpg, png, jpeg och gif.
                            if (
                                move_uploaded_file(
                                    $tmpname,
                                    "Images/News/$filename"
                                )
                            ) {
                                // Om bildfilen laddades upp till mappen News.
                                $bild = "Images/News/$filename";
                            } // Slut om bildfilen laddades upp till mappen News.
                            $dashboard->addNews(
                                $addtitle,
                                $addcat,
                                $addcontent,
                                $bild,
                                $_SESSION['loginuname']
                            );
                        } // Slut om användare bifogade bildfilen och bildtyper var jpg, png, jpeg och gif.
                    }
                    // Slut om det finns samtliga fält.
                } // Slut om användare klickade på Lägg till knappen. // Lägg till nyheter formuulär.
                echo '

                    </div>
                </div>
              <form action="addnews.php" id="addnewsform" method="post" enctype="multipart/form-data">
                    
                  <div class="row">
                    <div class="form-group col-md-7 col-xs-12">
                      <label for="addtitle" class="ml-3">Rubrik:*</label>
                        <input type="text" name="addtitle" class="form-control ml-2" id="addtitle" required />
                     </div>
                  </div>
                  
                  <div class="row">
                    <div class="form-group col-md-7 col-xs-11">
                      <label for="addcat" class="ml-3">Kategori:*</label>
                          <select name="addcat" class="ml-1 form-control" id="addcat" required>';
                $dashboard->getList();
                echo '
                       </div>
                    </div>


                  <div class="row">
                    <div class="form-group col-md-7">
                      <label class="ml-3">Innehåll:*</label>
                        <textarea name="addcontent" class="addcontent ml-5 form-control" id="addcontent"></textarea>
                    </div>
                  </div>
                    <br />
                    
                  <div id="addimglabel" class="ml-3">Bild:*</div>

                    <div class="form-group">
                      <div class="input-group input-file">
                            <input type="file" class="form-control col-sm-2" name="addimg" accept="image/*" id="addimg" required />
                      </div>
                    </div>

                    
                    <div class="row">
                      <div class="form-group col-md-7">
                        <input class="btn btn-primary btn-lg" name="addbtn" id="addbtn" type="submit" value="Lägg till" />
                      </div>
                    </div>
                  </form>

                </div>';
            }
            // Slut om användaren har administratörsbehörigheter.
            else {
                // Om användaren inte har administratörsbehörigheter.
                header("location: index.php");
            } // Om användaren inte har administratörsbehörigheter.
        }
        // Slut om man är inloggad.
        else {
            // Om man inte är inloggad.
            header("location: ../login.php?msg=true");
        }
// Slut om man inte är inloggad.
?>
    </div>

<script>
  // CKeditor inställningar.
    ClassicEditor
    .create( document.querySelector( '#addcontent' ), {
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
           
