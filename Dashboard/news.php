<?php ob_start(); ?>
<?php $title = "Nyheter"; ?>
<?php require "Includes/header.php"; ?>
<?php require "Includes/nav.php"; ?>

  <div class="container-fluid">
    <div id="main" class="mymain">
  
<div class="container-fluid">

<!-- Nyhetersdelen -->  
  <img src='Images/Ikoner/news.png' class='img-fluid specheadicon' alt='Nyhetersikon' />
        <h2 class='rubrik specrubriktxt ms-3'>Alla nyheter</h2>
    <br />
  
  <?php
  if (isset($_SESSION['loginuname'])) {
      // Om man är inloggad.
      if ($dashboard->checkadminuser($_SESSION['loginuname']) == 1) {
          // Om användaren har administratörsbehörigheter.
          echo "
            <form action='addnews.php' method='post'>
              <button type='submit' class='btn btn-primary ms-1 mb-3'>Nytt nyhetsinlägg</button>
            </form>";
      } // Slut om användaren har administratörsbehörigheter.
      $dashboard->getNews($_SESSION['loginuname']);
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