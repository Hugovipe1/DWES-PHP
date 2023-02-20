<?php
    include("lib/functions.php");
    include("config/config.php");
    
    session_start();
    if(!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "admin"){
        header("Location: index.php");
    }

    $db = conectaBD();
    $procesaFormulario = false;
    if (isset($_POST["add"])) {
        $procesaFormulario = true;
    }
    if (isset($_POST["enviar"])) {
        addTeam($db, $_POST);
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
    <?php
    if ($procesaFormulario) {
    ?>
    <form action="" method="POST">
        <input type="text" name="nombre">
        <input type="submit" name="enviar" value="Añadir equipo">
    </form>
    <?php
    }
    ?>
    <form action="" method="POST">
    <input type="submit" name="inicio" value="Volver al inicio">
    </form>
</body>
</html>