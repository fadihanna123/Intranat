<?php $title = "Senaste nytt"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>

  <div class="container-fluid">
    <div id="main" class="mymain">
        <!-- De senaste nyheter -->
        <h1 class="ml-3">Senaste nytt från 
          <?php echo $dashboard->getCompanyName(); ?>
        </h1>

<?php 

if (!isset($_SESSION['loginuname'])) {
    // Om man inte är inloggad.
    header("location: ../login.php?msg=true");
}
// Slut om man inte är inloggad.
else {
    // Om man är inloggad.
    $dashboard->getNewsHome();
} // Slut om man är inloggad.
?></div>
  </div>
<?php require "Includes/footer.php"; ?>