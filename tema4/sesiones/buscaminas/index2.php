<?php
session_start();
$_SESSION["enteros"][0][0] = 5;
$_SESSION["enteros"][0][1] = 4;

$_SESSION["enteros"] = funcion();
var_dump($_SESSION["enteros"]);

function funcion(){
    $array1 = $_SESSION["enteros"];
    var_dump($array1);
    return $array1;
}
session_destroy();
?>