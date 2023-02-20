<?php
include("./config/config.php");
include("./lib/functions.php");
session_start();
if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = array();
    $_SESSION["zona"] = "";
    $_SESSION["precioTotal"] = 0;
    $_SESSION["abonados"] = generaAbonados(NUM_ABONADOS);
    $_SESSION["usuario"] = "invitado";
}
$msg_error = "";

if (isset($_POST["login"])) {
    $user = clearData($_POST["user"]);
    $pass = clearData($_POST["pass"]);
    if (($user == "usuario") && ($pass == "usuario")) {
        $_SESSION["usuario"] = "usuario";
    }
    else {
        $msg_error = "Error de autentificación";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificación</title>
</head>
<h1>Liga de baloncesto Pokemon</h1>
<body>
    <div>
        <?php
        if ($_SESSION["usuario"] == "invitado") {
            include("login_form.html");
            echo $msg_error;
        }
        else {
            echo "Usuario: $_SESSION[usuario] <a href=\"logout.php\">Salir</a>";
        }

        ?>
    </div>
    <div>
        <nav>
            <a href="index.php">Home</a>
        <?php
            if ($_SESSION["usuario"] == "usuario") {
                echo "<a href=\"ventas.php\">Ventas</a>";
            }

        ?>
        </nav>
    </div>
</body>
</html>





