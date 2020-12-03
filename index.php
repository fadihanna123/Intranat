<?php session_start(); ?>
<?php $title = "Startsida"; ?>
<?php require "Includes/header.php"; ?>
<!-- Mittensdelen -->
<div class="container-fluid">
  <?php

    if (isset($_SESSION['loginuname'])) {
        // Om man är inloggad.
        header("location: Dashboard/index.php");
    } // Slut om man är inloggad.
    if (isset($_GET['msg']) && $_GET['msg'] == "true") {
        // Om det skickades varningsmeddelande i adressfältet.
        echo "<br /><div class='alert alert-info text-center'>
                    Du är utloggad nu.<br /> 
                    Välkommen tillbaka.
                </div>";
    }

  // Slut om det skickades varningsmeddelande i adressfältet.

?>
   <!-- Mittenstext -->
  <h1 class="rubrik text-center">Välkommen till<br /><?= $getname ?></h1>
<p class="text-center">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent aliquam aliquam<br /> 
        metus, at dapibus lacus mattis ut. Pellentesque semper nunc ac ante tristique, in<br />
        dapibus diam luctus. Fusce cursus turpis at nisl venenatis vulputate. Praesent tempor<br />
        , augue sit amet mattis porttitor, turpis ligula volutpat augue, eget interdum tortor<br /> 
        sem in magna. Proin facilisis, nisl vel viverra cursus, quam risus pharetra dui, eu<br /> 
        tincidunt ex metus vitae nisl. Curabitur id neque dignissim, maximus diam eu,<br />
        imperdiet ante. Sed eleifend vehicula sagittis. Cras eu lectus tellus. Nunc ut velit<br /> 
        lectus. Morbi non diam ligula. Morbi velit massa, vulputate at efficitur vel,<br />
        pulvinar sit amet sapien. In lectus enim, maximus sit amet felis sed, molestie ornare<br />
        erat. Praesent faucibus turpis a tristique commodo. Curabitur consequat felis id<br /> 
        sapien semper, at sagittis massa interdum. Quisque pellentesque mi non diam<br /> 
        condimentum tincidunt. Fusce porttitor sapien ac varius consequat. Vivamus ut<br /> 
        vulputate tellus. Nam nisl urna, dignissim vel nulla eu, condimentum porta eros. Ut<br /> 
        pellentesque odio eu viverra porttitor. Nullam lobortis justo a mattis sollicitudin.<br /> 
        Nunc ut neque vitae sem vulputate porta nec nec nisl. Suspendisse ultricies sem ut<br /> 
        nunc dapibus, vitae fringilla quam tempus. Pellentesque egestas nibh sit amet felis<br /> 
        interdum fermentum. Aliquam nisi orci, suscipit sit amet leo non, pharetra cursus<br /> 
        enim. Aenean sollicitudin at augue ut efficitur. Donec posuere lobortis lorem. Nam<br /> 
        dolor arcu, volutpat a eros sed, fringilla feugiat est. Curabitur suscipit dolor<br /> 
        iaculis pellentesque euismod. Sed a nibh eleifend, tristique eros sed, tincidunt<br /> 
        augue. Vestibulum enim eros, pretium ut ex non, commodo varius arcu. In vitae sem<br /> 
        nibh. Proin a turpis urna. Duis fringilla quis urna ut efficitur. Ut vel lacus<br /> 
        pharetra, consequat leo id, consectetur eros. Sed orci leo, lacinia nec semper eu,<br /> 
        tempus vitae lectus. Integer in orci tristique, lacinia augue sed, tempor nunc.<br /> 
        Vivamus hendrerit suscipit ipsum, sit amet dictum nulla faucibus eget. Lorem ipsum<br /> 
        dolor sit amet, consectetur adipiscing elit. Nunc est ipsum, rhoncus sed augue sed,<br /> 
        fermentum tincidunt augue. Pellentesque vel placerat neque. Quisque nibh magna,<br /> 
        aliquet sed fringilla ac, lacinia quis ex.


</p>
</div>

<?php require "Includes/footer.php"; ?>
