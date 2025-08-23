<?php ob_start(); ?>
<?php session_start(); ?>
<?php $title = "Adminpanel"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>


  <div class="container-fluid">
    <div class="mymain">
    
    <?php
    $dashboard = new Dashboard();
    $editimglogo = isset($_FILES['editimglogo']['name'])
        ? $_FILES['editimglogo']['name']
        : "";
    $filetype = isset($_FILES['editimglogo']['type'])
        ? $_FILES['editimglogo']['type']
        : "";
    $tmpname = isset($_FILES['editimglogo']['tmp_name'])
        ? $_FILES['editimglogo']['tmp_name']
        : "";
    $editaddressstreet = strip_tags(
        htmlentities(
            isset($_POST["editaddressstreet"])
                ? $_POST["editaddressstreet"]
                : ""
        )
    );
    $editaddressbox = strip_tags(
        htmlentities(
            isset($_POST["editaddressbox"]) ? $_POST["editaddressbox"] : ""
        )
    );
    $editaddresscity = strip_tags(
        htmlentities(
            isset($_POST["editaddresscity"]) ? $_POST["editaddresscity"] : ""
        )
    );
    $editorgnr = strip_tags(
        htmlentities(isset($_POST["editorgnr"]) ? $_POST["editorgnr"] : "")
    );
    $editvisitaddress = strip_tags(
        htmlentities(
            isset($_POST["editvisitaddress"]) ? $_POST["editvisitaddress"] : ""
        )
    );
    $editfirstcolor = strip_tags(
        htmlentities(
            isset($_POST["editfirstcolor"]) ? $_POST["editfirstcolor"] : ""
        )
    );
    $editsecondcolor = strip_tags(
        htmlentities(
            isset($_POST["editsecondcolor"]) ? $_POST["editsecondcolor"] : ""
        )
    );
    $editcompanyname = strip_tags(
        htmlentities(
            isset($_POST["editcompanyname"]) ? $_POST["editcompanyname"] : ""
        )
    );
    $editinvoiceinfo = html_entity_decode(
        isset($_POST["editinvoiceinfo"]) ? $_POST["editinvoiceinfo"] : ""
    );
    if (isset($_SESSION['loginuname'])) {
        // Om man är inloggad.
        if ($dashboard->checkadminuser($_SESSION['loginuname']) == "1") {
            if (isset($_POST['adminapprovebtn'])) {
                // Om användare klickade på Godkänna knappen.
                $getid = $_POST['getid'];
                $dashboard->AcceptStaff($getid);
            } // Slut om användare klickade på Godkänna knappen.
            if (isset($_POST['editadmininfobtn'])) {
                // Om användare klickade på Uppdatera knappen.
                if (
                    isset($editimglogo) &&
                    ($filetype =
                        "image/jpg" &&
                        ($filetype =
                            "image/png" &&
                            ($filetype =
                                "image/jpeg" && ($filetype = "image/gif"))))
                ) {
                    // Om användare bifogade bildfil och bildtyper var jpg, png, jpeg och gif.
                    if (
                        move_uploaded_file(
                            $tmpname,
                            "Images/Admin/$editimglogo"
                        )
                    ) {
                        // Om bildfilen överfördes till Admin mappar.
                        $bild = "Images/Admin/$editimglogo";
                        copy($bild, "../Images/Admin/" . $editimglogo);
                    } // Slut om bildfilen överfördes till Admin mappar.
                }
                // Slut om bildtyper var jpg, png, jpeg och gif.
                $dashboard->UpdateAdminSettings(
                    $editcompanyname,
                    isset($bild) ? $bild : "",
                    $editorgnr,
                    $editinvoiceinfo,
                    $editaddressstreet,
                    $editaddressbox,
                    $editaddresscity,
                    $editvisitaddress,
                    $editfirstcolor,
                    $editsecondcolor
                );
            }
            // Slut om användare klickade på Uppdatera knappen.
            if (isset($_POST['addcatbtn'])) {
                // Om användare klickade på Lägg till knappen.
                $addcatname = strip_tags(
                    htmlentities(
                        isset($_POST['addcatname']) ? $_POST['addcatname'] : ""
                    )
                );
                $addcatdb = strip_tags(
                    htmlentities(
                        isset($_POST['addcatdb']) ? $_POST['addcatdb'] : ""
                    )
                );
                if (empty($addcatname) || empty($addcatdb)) {
                    // Om man inte fyllde in alla obligatoriska fält.
                    echo "<div class='alert alert-danger'>
                                            Du behöver fylla in alla obligatoriska fält.
                                      </div>";
                }
                // Slut om man inte fyllde in alla obligatoriska fält.
                else {
                    // Om man fyllde in alla fält.
                    $dashboard->AddCategory($addcatname, $addcatdb);
                } // Om man fyllde in alla fält.
            } // Slut om användare klickade på Lägg till knappen.
            echo '
                      <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                              <img src="Images/Ikoner/admin.png" class="img-fluid adminicon" alt="Administratörsikon" />
                                <h2 class="rubrik specrubriktxt">Administratörsinställningar</h2>
                                    <p class="specrubriktxt">
                                      Här kan du ändra företagets inställningar.
                                    </p>';
            $dashboard->GetAdminForm();
            echo "
                        <div class='col-sm-6'>
                          <img src='Images/Ikoner/add-1.png' class='img-fluid specheadicon ms-1' alt='Lägg till ikon' />
                            <h2 class='rubrik specrubriktxt ms-2 text-nowrap'>Lägg till kategorier</h2>";
            $dashboard->GetAddCategoriesForm();
            echo "
                        <div class='col-sm-10'>
                          <img src='Images/Ikoner/confirm.png' class='img-fluid specheadicon ms-1' alt='Godkännaikon' />
                          <h2 class='rubrik specrubriktxt ms-2 text-nowrap'>Godkänna personal</h2>";
            $dashboard->GetApproveList();
            echo "</div></div>";
        }
        // Slut om man har administratörsbehörigheter.
        else {
            // Om användaren inte har administratörens behörigheter.
            echo "<div class='alert alert-danger mt-3'>
                        Denna funktion är låst.
                      </div>";
        }
        // Slut om användaren inte har administratörens behörigheter
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
    .create( document.querySelector( '#editinvoiceinfo' ), {
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
        console.log(`❌ ${error}`);
    } );
    
    </script>
      </div>
  </div>
  </div>
</div>
  <?php require "Includes/footer.php"; ?>
           