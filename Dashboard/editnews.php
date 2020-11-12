<?php ob_start(); ?>
<?php session_start(); ?>
<?php $title = "Ändra nyhetsinlägg"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>
<div class="container-fluid">
<div id="main" class="mymain">
<?php
$dashboard = new Dashboard();
$getid = $_GET['id'];
if (!isset($getid)) {
    // Om användaren saknar rätt id.
    header("location: news.php");
} // Om användaren saknar id
if (isset($_SESSION['loginuname'])) {
    // Om man är inloggad.
    if ($dashboard->checkadminuser($_SESSION['loginuname']) == 1) {
        // Om användaren har administratörsbehörigheter.
        echo '<img src="Images/Ikoner/register.png" class="img-fluid specheadicon2" alt="Redigera nyhet ikon" />
              <h2 class="rubrik ml-5">Uppdatera nyhetsinlägget</h2>
              <div class="container-fluid">
                <div id="editnewsmain">';
        $edittitle = strip_tags(
            htmlentities(isset($_POST["edittitle"]) ? $_POST["edittitle"] : "")
        );
        $editcat = strip_tags(
            htmlentities(isset($_POST["editcat"]) ? $_POST["editcat"] : "")
        );
        $editcontent = isset($_POST["editcontent"])
            ? $_POST["editcontent"]
            : "";
        $filename = isset($_FILES['editimg']['name'])
            ? $_FILES['editimg']['name']
            : "";
        $filetype = isset($_FILES['editimg']['type'])
            ? $_FILES['editimg']['type']
            : "";
        $tmpname = isset($_FILES['editimg']['tmp_name'])
            ? $_FILES['editimg']['tmp_name']
            : "";
        if (isset($_POST['editbtn'])) {
            // Om användare klickade på Uppdatera knappen.
            if (
                isset($filename) &&
                ($filetype =
                    "image/jpg" &&
                    ($filetype =
                        "image/png" &&
                        ($filetype =
                            "image/jpeg" && ($filetype = "image/gif"))))
            ) {
                // Om användare bifogade bildfil och bildtyper var jpg, png, jpeg och gif.
                if (move_uploaded_file($tmpname, "Images/News/$filename")) {
                    // Om bildfilen överfördes till mappen News.
                    $bild = "Images/News/$filename";
                } // Slut om bildfilen överfördes till mappen News.
                $dashboard->UpdateNews(
                    $getid,
                    $edittitle,
                    $editcat,
                    $editcontent,

                    isset($bild) ? $bild : "",
                    $_SESSION['loginuname']
                );
            } // Slut om användare bifogade bildfilen.
        } // Slut om användare klickade på Uppdatera knappen.
        $dashboard->GetNewsValues($_GET['id']);
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

      <script>
      // CKeditor inställningar
      ClassicEditor
    .create( document.querySelector( '#editcontent' ), {
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
    </div>
  <?php require "Includes/footer.php"; ?>
           
