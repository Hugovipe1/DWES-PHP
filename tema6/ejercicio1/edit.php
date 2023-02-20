<?php
include("lib/functions.php");
include("config/config.php");
session_start();
if(!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "admin"){
    header("Location: index.php");
}
$db = conectaBD();
$id = $_GET["id"];
$equipo = getEquipoById($db,$id);
if (isset($_POST["enviar"])) {
    // Limpiar datos enviados a la base de datos
    editTeam($db, $_POST);
    header("Location: index.php");
}

if (isset($_POST["inicio"])) {
    header("Location: index.php");
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
<h1>CB_POKEMONS</h1>
    <form action="" method="POST">
        
        <?php
        foreach ($equipo as $key => $value) {
            echo "Nombre nuevo a poner <input type=\"text\" name=\"nombre\" value=\"$value[equipo]\">";
        }
        
        echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
        ?>
        
        <input type="submit" name="enviar" value="Confirmar nombre">
    </form>
    <form action="" method="POST">
        <input type="submit" name="inicio" value="Volver al inicio">
    </form>
</body>
</html>