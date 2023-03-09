<?php
/**
 * @author Hugo Vicente Peligro
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Inicio</title>
</head>
<body>
    <h1>Gestión de multas</h1>
    <?php
    if($_SESSION["perfil"] == "invitado"){
        include "login_view.php";
    }
    else if($_SESSION["perfil"] != "invitado"){
        echo "Bienvenido has inciado sesión como ".$_SESSION["perfil"];
        echo "<br><a href='/logout'>Cerrar sesión</a>";
    }
    echo "<nav>";
    echo "<a href=\"/\">Home</a>&nbsp";
    if ($_SESSION["perfil"] == "agente") {
        echo "&nbsp<a href='/multas/listado'>Listado Multas</a>";
        echo "&nbsp<a href='/multas/add'>Añadir Multas</a>";
    } 
    if ($_SESSION["perfil"] == "conductor") {
        echo "&nbsp<a href='/multas/ver'>Multas</a>";
    }
    if ($_SESSION["perfil"] == "admin") {
        echo "&nbsp<a href='/conductores/listado'>Listado Conductores</a>";
    }
    echo "</nav><br/>";

    echo "<iframe width=\"560\" height=\"315\" src=\"".$data["video"] ."\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>";
    
    ?>
</body>
</html>