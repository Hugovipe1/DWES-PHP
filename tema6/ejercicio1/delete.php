<?php
include("lib/functions.php");
include("config/config.php");
session_start();
if(!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "admin"){
    header("Location: index.php");
}
else {
    $db = conectaBD();
    deleteTeam($db, $_GET["id"]);
    header("Location: index.php");
}
?>