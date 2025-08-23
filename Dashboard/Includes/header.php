<?php 

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

?>
<?php require "Includes/config.php"; ?>
<!DOCTYPE html>
<html lang="sv">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=7" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="pragma" content="no-cache" />
  <script src="./ckeditor5/build/ckeditor.js"></script>
  <script src="./Js/main.js?t=<?= time() ?>"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./CSS/main.css?t=<?= time() ?>" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>  <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
  <link rel="apple-touch-icon" sizes="180x180" href="./Images/Favicon/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="./Images/Favicon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="./Images/Favicon/favicon-16x16.png" />
  <meta name="msapplication-TileColor" content="#da532c" />
  <meta name="theme-color" content="#ffffff" />
  <title>Intranätetet - <?= $title ?></title>
</head>
<body>
<?php
$dashboard = new Dashboard();
$getimg = $dashboard->getLogoImg(); // Logotypensdel.
echo "<div class='container-fluid'>
          <nav class='navbar header bg-light navbar-dark'>
            <a class='navbar-brand' href='index.php'>
              <img src='$getimg' class='img-fluid w-sm-100' id='logobild' alt='Logotypen' />
            </a>
              ";
?>
    
<?php if (isset($_SESSION['loginuname'])) {
    // Om man är inloggad.
    $dashboard = new Dashboard(); // Navigeringsmeny.
    echo '<div class="ms-auto me-4 inloggad">Inloggad som: ' .
        $dashboard->getFullName($_SESSION['loginuname']) .
        '
          </div>  
            
            <div class="justify-content-end" id="navmeny">
              <ul class="navbar-nav text-dark">
                <li class="nav-item">
                  <form action="./logout.php">
                    <button class="btn btn-danger logoutbtn text-light btn-lg">
                        Logga ut
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </nav>
          </div>
        ';
}
// Slut om man är inloggad.
else {
    // Om man inte är inloggad.
    header("location: ../login.php?msg=true");
} // Slut om man inte är inloggad.
?>