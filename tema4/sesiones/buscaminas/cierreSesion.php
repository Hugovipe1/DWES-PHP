<?php
/**
 * @author Hugo Vicente Peligro
 */
session_start();

session_destroy();
unset($_SESSION["tablero"]);
unset($_SESSION["tableroMostrado"]);

header("location:index.php");
?>