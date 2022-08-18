<?php

session_start();
unset($_SESSION['loginuname']);
if (session_destroy()) {
    // Om sessionsvariabler har tagits bort.
    header("location: ../index.php?msg=true");
} // Slut om sessionsvariabler har tagits bort.