<?php
/**
 * 
 * página para visualizar un contador de pulsaciones.
 * @author Hugo Vicente Peligro
 */
session_start();

if(!isset($_SESSION["inicioTime"])){
    $_SESSION["inicioTime"] = time();
    $_SESSION["contador"] = 0;
}
$_SESSION["contador"]++;
echo $_SESSION["contador"];
$tiempo = 0;
$tiempoTranscurrido = time();
$tiempo_maximo = $_SESSION["inicioTime"] +  5;
if($tiempoTranscurrido > $tiempo_maximo){
    $_SESSION["contador"] = 0;
    $_SESSION["inicioTime"] = time();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
</body>
</html>