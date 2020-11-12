<?php ob_start(); ?>
<?php $title = "Filarkiv"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>

  <!-- Mittensdel -->
  <div class="container-fluid">
    <div id="main" class="mymain">
      <?php if (isset($_SESSION['loginuname'])) {
          // Om man är inloggad.
          if ($dashboard->checkadminuser($_SESSION['loginuname']) == 1) {
              // Om användaren har administratörsbehörigheter.
              if (isset($_GET['msg']) && $_GET['msg'] == "true") {
                  // Om det finns msg och är true i adressfältet.
                  echo "<div class='alert alert-success ml-4 w-75'>
                          Filen lades till i databasen.
                      </div>";
              } // Slut om det finns msg och är true i adressfältet.
              if (isset($_GET['fail']) && $_GET['fail'] == "true") {
                  // Om det fail msg och är true i adressfältet.
                  echo "  <script>
                          alert('Filen som du söker hittades inte i vår register.');
                        </script>";
              } // Slut om det finns fail i adressfältet och är true.
              $addfilename = strip_tags(
                  html_entity_decode(
                      isset($_POST["addfilename"]) ? $_POST["addfilename"] : ""
                  )
              );
              $adddes = html_entity_decode(
                  isset($_POST["adddes"]) ? $_POST["adddes"] : ""
              );
              $addcat = strip_tags(
                  htmlentities(isset($_POST["addcat"]) ? $_POST["addcat"] : "")
              );
              $filename = isset($_FILES['addfile']['name'])
                  ? $_FILES['addfile']['name']
                  : "";
              $filetype = isset($_FILES['addfile']['type'])
                  ? $_FILES['addfile']['type']
                  : "";
              $addfilesize = isset($_FILES['addfile']['size'])
                  ? $_FILES['addfile']['size']
                  : "";
              $tmpname = isset($_FILES['addfile']['tmp_name'])
                  ? $_FILES['addfile']['tmp_name']
                  : "";
              if (isset($_POST['addfilebtn'])) {
                  // Om användare klickade på Ladda upp knappen.
                  if (
                      empty($filename) ||
                      empty($adddes) ||
                      empty($addfilename)
                  ) {
                      // Om man inte fyllde in alla obligatoriska fält.
                      echo "<div class='alert alert-danger'>
                                  Du behöver fylla in de obligatoriska fält.
                            </div>";
                  }
                  // Slut om man inte fyllde in alla obligatoriska fält.
                  else {
                      // Om man fyllde in alla fält.
                      if (
                          move_uploaded_file($tmpname, "Images/Files/$filename")
                      ) {
                          // Om bildfilen överfördes till mappen Files.
                          $bild = "Images/Files/$filename";
                      }
                      // Slut om bildfilen överfördes till mappen Files.
                      $dashboard->AddFile(
                          $addfilename,

                          $adddes,
                          $addcat,
                          $filename,
                          $addfilesize
                      );
                  } // Om man fyllde in alla fält.
              } // Slut om användare klickade på Ladda upp knappen.
              // Filuppladdningsformulär.
              echo '<div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-10">
                                  <img src="Images/Ikoner/upload.png" class="img-fluid uploadicon" alt="Ladda upp ikonen" />
                                    <h1 class="ml-5 uploadheading">Ladda upp filer</h1><br />
                          
                                        <form action="filarkiv.php" id="addfileform" method="post" enctype="multipart/form-data" class="p-4 myform w-100">
                                    
                                                <div class="row">
                                                  <div class="form-group col-md-7">
                                                    <label id="addfilenamelabel" for="addfilename">Namn:*</label>
                                                      <input type="text" name="addfilename" class="form-control" id="addfilename" required />
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="form-group col-md-7">
                                                      <label id="addfilelabel" for="addfile">Dokument:*</label>
                                                        <input type="file" name="addfile" class="form-control" id="addfile" required />
                                                    </div>
                                                 </div>

                                                 <div class="row">
                                                  <div class="form-group col-md-7">
                                                      <label for="addcat">Kategori:*</label>
                                                      <select name="addcat" id="addcat" class="ml-1 form-control">
                                                      <option value="">Välj</option>
                                                      <option value="">---</option>';
              $dashboard->getArkivCategories();
              echo '</select>
                                                </div>
                                                          </div>
                                            
                                                        <div class="row">
                                                          <div class="form-group col-md-7">
                                                            <label id="adddeslabel" for="adddes">Beskrivning:*</label>
                                                              <textarea class="adddes" name="adddes" id="adddes"></textarea>
                                                        </div>
                                                        </div>      
                                                        
                                            
                                                        <div class="row">
                                                          <div class="form-group mx-auto col-md-7">
                                                            <input class="btn btn-primary btn-lg" name="addfilebtn" id="addfilebtn" type="submit" value="Ladda upp" />
                                                          </div>
                                                        </div>
                                                </form>
                          </div></div></div></div><br /><div class="container">
                ';
          }
          // Slut om användaren har administratörsbehörigheter.
          else {
              // Om användaren inte har administratörsbehörigheter.
              echo "<div class='container-fluid'>";
          }
          // Slut om användaren inte har administratörsbehörigheter.
          echo "
                    <img src='Images/Ikoner/arkiv.png' class='arkivicon img-fluid' alt='Filarkivikon' />
                         <h1>Filarkiv</h1><br />";
          $dashboard->GetArkiv($_SESSION['loginuname']);
          echo "</div>";
      }
      // Slut om man är inloggad.
      else {
          // Om man inte är inloggad.
          header("location: ../login.php?msg=true");
      }
// Slut om man inte är inloggad.
?>
   </div>
   </div>

   <script>
     // CKeditor inställningar.
        ClassicEditor
    .create( document.querySelector( '#adddes' ), {
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

