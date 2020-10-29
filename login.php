<?php session_start(); ?>
<?php $title = "Logga in"; ?>
<?php require("Includes/header.php"); ?>



<!-- Inloggningstext -->
<div class="container text-center">
    <h2 class="rubrik">Logga in</h2>
    <p>Här kan du logga in.</p>
    <!-- Inloggningsmeddelande -->
    <div class="container-fluid">
      <div id="loginmain">
      
      <?php
        if (isset($_SESSION['loginuname']))
          { // Om användare är inloggad.
            header('location: Dashboard/index.php');
          } // Slut om användare är inloggad.

        if (isset($_GET['msg']) && $_GET['msg'] == "true")
        { // Om det skickades varningsmeddelande i adressfältet.
          echo "<div class='alert alert-danger'>
                    Du måste logga in först.
                </div>";  
        } // Slut om det skickades varningsmeddelande i adressfältet.

    $loginuname =  strip_tags(htmlentities(isset($_POST["loginuname"]) ? $_POST["loginuname"] : ""));
    $loginpsw = strip_tags(htmlentities(isset($_POST["loginpsw"]) ? $_POST["loginpsw"] : ""));
    if (isset($_POST['loginbtn']))
    { // Om användare klickade på Logga in knappen.
      
      if (empty($loginuname) || empty($loginpsw))
      { // Om det saknas samtliga data för inloggning.
              echo "<div class='alert alert-danger'>
                          Du behöver fylla in samtliga fält.
                    </div>";
      } // Slut om det saknas samtliga data för inloggning.
      else 
      { // Om det finns samtliga data för inloggning.
        
        $functions->checklogin($loginuname, $loginpsw);
        
      } // Slut om det finns samtliga data för inloggning.

    } // Slut om användare klickade på Logga in knappen.
?>

      
      </div>
  </div>
    <!-- Inloggningsformulär -->
    <div class="container h-100">
      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="needs-validation col-12" novalidate>
      <div class="row h-100 justify-content-center align-items-center">
        <div class="form-group">
            <label for="loginuname">Användarnamn:</label>
            <input type="text" name="loginuname" id="loginuname" class="form-control" required />

        </div>
      </div>
      <div class="row h-100 justify-content-center align-items-center">
        <div class="form-group">
            <label for="loginpsw">Lösenord:</label>
            <input type="password" class="form-control" id="loginpsw" name="loginpsw" required /><br />
          </div>
        </div>
        <button class="btn btn-primary mb-5 mr-1 btn-lg" type="submit" name="loginbtn">Logga in</button>
      </form>
    </div>
  </div>
  <div class="container text-center">
    <p>Har du glömt ditt lösenord? <a href="forgetpsw.php">Klicka här</a> för att återställa ditt lösenord.</p>
    <p>Är du inte registrerad redan? <a href="register.php">Klicka här</a> för att registrera dig.</p>
  </div>

  <?php require("Includes/footer.php"); ?>
