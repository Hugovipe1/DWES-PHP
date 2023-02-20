<?php
/**
 * @author Hugo Vicente Peligro
 */

 session_start();
 if (!isset($_SESSION["perfil"])) {
    $_SESSION["perfil"] = "invitado";
    $_SESSION["user"] = [];
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
    <header>
        <h1>Ejercicio 1</h1>
    </header>
    <div>
        <?php
        if ($_SESSION["perfil"] == "invitado") {
            include("./include/login_form.php");
            echo "No tienes cuenta <a href=\"registro.php\">Registrate</a>";
        }
        else {
            echo("Estas cómo $_SESSION[perfil]");
            echo("<a href=\"salir.php\">Salir</a>");
        }

        ?>
    </div>
    <div>
        <?php
        foreach ($perfiles as $key => $value) {
            if ($_SESSION["perfil"] == $key) {
                foreach ($value as $key2 => $value2) {
                    echo "<a href=\"../include/$value2\"></a>";
                }
            } 
        }
        ?>


    </div>
    <div></div>
    
</body>
</html>