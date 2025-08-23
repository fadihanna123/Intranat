<?php ob_start(); ?>
<?php session_start(); ?>
<?php $title = "Radera nyhetsinlägget"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>
<?php $dashboard = new Dashboard(); ?>
<div class="container-fluid">
  <div id="main" class="mymain">
  <?php if (isset($_SESSION['loginuname'])) {
    // Om man är inloggad.
    if ($dashboard->checkadminuser($_SESSION['loginuname']) == 1) {
        // Om användaren har administratörsbehörigheter.
        $getid = $_GET['id'];
        if (isset($_POST['deletebtn'])) {
            // Om användare klickade på Radera knappen.
            $dashboard->DeleteNews($getid);
            exit();
        } // Slut om användare klickade på Radera knappen.
        echo '<h2 class="rubrik ms-1">Är du säker att du vill ta bort detta inlägg?</h2>
         
        <div class="container-fluid">
            <div>';
        if (!isset($getid) || $getid == "") {
            // Om id saknas.
            echo "<div class='alert alert-danger'>
                    Nyhetsinlägget som du söker hittades inte.
                </div>";
        } // Slut om id saknas.
        echo "</div></div>";
        $dashboard->showFullContent($getid);
        echo "
              <form action='././deletenews.php?id=$getid' method='post' class='p-2'>
                <input class='btn btn-danger btn-lg' name='deletebtn' id='deletebtn' type='submit' value='Radera' />  
              </form>

            ";
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
    </div></div>
      
  <?php require "Includes/footer.php"; ?>
           