<?php ob_start(); ?>
<?php $title = "Personal"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>

  <div class="container-fluid">
    <div id="main" class="mymain">
  
  
  <?php if (isset($_SESSION['loginuname'])) {
    // Om man är inloggad.
    echo "<div class='container-fluid'>";
    $dashboard->GetStaff();
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
<?php require "Includes/footer.php"; ?>