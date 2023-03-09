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
    <title>Listado Conductores</title>
</head>
<body>
    <h1>Gestión Multas</h1>
    
    <?php
    if($_SESSION["perfil"] != "invitado"){
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
    ?>
    <form action="" method="post">
        <label>Listado de Conductores: <input type="text" name="nombre"></label>
        <input type="submit" name="buscar" value="Buscar">
    </form>
    <br />
    <?php
    echo "<h2>Listado Conductores</h2>";
    foreach ($data["conductores"] as $key => $value) {
        echo "<p>Conductor: ".$value["nombre"]."</p>";
        echo "<p>Puntos: ".$value["puntos"]."</p>";
        // echo "<p>Sanciones: ".$value["numMultas"]."</p>";
        echo "<p>------------------------------------</p>";
    }
    ?>
</body>
</html>