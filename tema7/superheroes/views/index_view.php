<?php
/**
 * @author Hugo Vicente Peligro
 */
require("../vendor/autoload.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superhéroes</title>
</head>
<body>
    <h1>Superhéroes</h1>
    <?php
    include "login_view.php";
    echo "Estas dentro como $_SESSION[perfil]<br/><br/>";
    ?>
    <form action="" method="post">
        <label>Nombre a buscar: <input type="text" name="nombre"></label>
        <input type="submit" name="buscar" value="Buscar">
    </form>
    <br/>
    <?php
    if($_SESSION["perfil"] == "admin"){
        echo "<form action=\"superheroes/add\" method=\"post\">
            <input type=\"submit\" name=\"add\" value=\"Add\">
        </form>";
    }
    

    
    foreach ($data as $key => $value) {
        echo "<br/> id = $value[id]; nombre: $value[nombre]; velocidad: $value[velocidad] creado el $value[created_at]"; 
        if($_SESSION["perfil"] == "admin"){
            echo "    <a href=\"superheroes/edit/$value[id]\">edit</a>     <a href=\"superheroes/del/$value[id]\">delete</a><br/>";
        }      
    }

    if($_SESSION["perfil"] == "admin"){
        echo "  <br/><br/>  <a href=\"superheroes/logout\">Cerrar Sesión</a>";
    }      


    ?>
</body>
</html>