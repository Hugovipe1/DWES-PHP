<?php
    include("lib/functions.php");
    include("config/config.php");
    $db = conectaBD();
    session_start();
    if (!isset($_SESSION["usuario"])) {
        $_SESSION["usuario"] = "invitado";
        $_SESSION["perfil"] = "invitado";
    }

    if (isset($_POST["inicioSesion"])) {
        $arrayPerfil = getPerfil($db, $_POST);
        foreach ($arrayPerfil as $key => $value) {
            $_SESSION["perfil"] = $value["perfil"];
        }
        
    }
    $data = getAll($db);
    if (isset($_POST["buscar"])) {
        $data = getFilter($db, $_POST["equipo"]);
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
    if ($_SESSION["perfil"] == "invitado") {
        ?> 
        <form action="" method="POST">
            Usuario <input type="text" name="user">
            Contraseña <input type="password" name="passwd">
            <input type="submit" name="inicioSesion" value="Iniciar Sesion"><br/>
        </form>
    <?php   
    }
    ?>

    <?php
    if ($_SESSION["perfil"] == "admin") {
        echo "Has iniciado sesión como admin";
        
    }
    ?>

    <form action="" method="POST">
        <br/><input type="text" name="equipo">
        <input type="submit" name="buscar" value="Busqueda"><br/>
    </form>
    <?php
    if ($_SESSION["perfil"] == "admin") {
        echo "<form action=\"add.php\" method=\"POST\">";
        echo "<input type=\"submit\" name=\"add\" value=\"Add\">";
        echo "</form>";
        
    }
    ?>
    
    
    <?php
        foreach ($data as $key => $value) {
            echo "<br/>id = $value[id]; equipo = $value[equipo]";     
            if ($_SESSION["perfil"] == "admin") {
                echo "     <a href=\"edit.php?id=$value[id]\">edit</a>     <a href=\"delete.php?id=$value[id]\">delete</a>" ;
            }
        }
        if ($_SESSION["perfil"] == "admin") {
            echo "<br/><a href=\"cierreSesion.php\">Cerrar Sesion</a><br/>";
        }
        
    ?>
</body>
</html>