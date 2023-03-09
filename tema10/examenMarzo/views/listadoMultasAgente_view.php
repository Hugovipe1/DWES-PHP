<?php
/**
 * @author Hugo Vicente peligro
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado multas agente</title>
</head>
<body>
    <h1>Gestión de multas</h1>
    <?php
    echo "Bienvenido has inciado sesión como ".$_SESSION["perfil"];
    echo "<br><a href='/logout'>Cerrar sesión</a><br/><br/>";
    echo "<nav>";
    echo "<a href=\"/\">Home</a>&nbsp";
    if ($_SESSION["perfil"] == "agente") {
        echo "&nbsp<a href='/multas/listado'>Listado Multas</a>";
        echo "&nbsp<a href='/multas/add'>Añadir Multas</a>";
    } 
    if ($_SESSION["perfil"] == "conductor") {
        echo "&nbsp<a href='/multas/ver'>Multas</a>";
    }
    echo "</nav><br/>";
    echo "<h3>Listado de multas</h3>";
    foreach ($data["multas"] as $key => $value) {
        echo "<p>Matrícula: ".$value["matricula"]."</p>";
        echo "<p>Descripción: ".$value["descripcion"]."</p>";
        echo "<p>Fecha: ".$value["fecha"]."</p>";
        echo "<p>------------------------------------</p>";
    }
    ?>
</body>
</html>