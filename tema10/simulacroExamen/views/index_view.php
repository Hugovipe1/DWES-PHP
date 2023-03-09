<?php

/**
 * @author Hugo Vicente Peligro
 */
// require("../vendor/autoload.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CocinaSaludable</title>
</head>
<body>
    <h1>CocinaSaludable</h1>
    <?php
    include "login_view.php";
    echo "Estas dentro como $_SESSION[perfil]<br/><br/>";
    if ($_SESSION["perfil"] != "invitado") {
        echo "<a href=\"/logout\">Logout</a><br/><br/>";
    }
    ?>
    <form action="/" method="post">
        <label>Recetas a buscar: <input type="text" name="nombre"></label>
        <input type="submit" name="buscar" value="Buscar">
    </form>
    <br />
    <?php

    echo "<nav>";
    echo "<a href=\"/\">Inicio</a>";
    if ($_SESSION["perfil"] != "invitado") {
        echo"<a href=\"/recetas/favoritas\">Favoritas</a> ";
    }
    if ($_SESSION["perfil"] == "Collaborator") {
        echo "<a href=\"/recetas/add\">Añadir receta</a>";
    }
    if($_SESSION["perfil"] == "Admin"){
        echo "    <a href=\"/admin/documento\">Generar documento de pago</a>";
    }
    echo "</nav>";

    foreach ($data as $key => $value) {
        echo "<h3>$value[titulo]</h3>";
        echo   "<p>$value[ingredientes]</p>";
        echo  "<p>$value[elaboracion]</p>";
        echo  "<p>$value[etiquetas]</p>";
        echo  "<p><img src=\"img/$value[imagen]\" alt=\"imagen\"></p>";
        if ($_SESSION["perfil"] == "Collaborator" && ($value["idColaborador"] == $_SESSION["id"])) {
            echo "    <a href=\"recetas/edit/$value[id]\">edit</a>     <a href=\"recetas/del/$value[id]\">delete</a><br/>";
        }
        if ($_SESSION["perfil"] != "invitado") {
            echo "<form action=\"\" method=\"post\">";
            echo "<label>Votación</label>";
            echo "<select name=\"votacion\">";
                echo "<option value=\"1\">1</option>";
                echo "<option value=\"2\">2</option>";
                echo "<option value=\"3\">3</option>";
                echo  "<option value=\"4\">4</option>";
                echo "<option value=\"5\">5</option>";
            echo "</select>";
            echo "<input type=\"hidden\" name=\"idReceta\" value=\"$value[id]\">";
            echo "<input type=\"submit\" name=\"votar\" value=\"Añadir\">";
            echo "</form>";
            echo "<form action=\"\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"idReceta\" value=\"$value[id]\">";
            echo "<input type=\"submit\" name=\"favoritos\" value=\"Añadir a Favoritos\">";
            echo "</form>";

        }
    }

    // if($_SESSION["perfil"] == "admin"){
    //     echo "    <a href=\"superheroes/edit/$value[id]\">edit</a>     <a href=\"superheroes/del/$value[id]\">delete</a><br/>";
    // }      


    // if($_SESSION["perfil"] == "admin"){
    //     echo "  <br/><br/>  <a href=\"superheroes/logout\">Cerrar Sesión</a>";
    // }      
    ?>
</body>

</html>