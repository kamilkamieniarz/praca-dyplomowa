<?php
    session_start();
    $_SESSION = array(); // usuwanie wszystkich zmiennych z $_SESSION
    session_destroy();
    header("Location: index.php");
?>