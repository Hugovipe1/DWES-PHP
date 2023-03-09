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
    <title>Pago de multas</title>
</head>

<body>
    <h1>Gestión de multas</h1>
    <?php
    if ($_SESSION["perfil"] != "invitado") {
        echo "Bienvenido has inciado sesión como " . $_SESSION["perfil"];
        echo "<br><a href='/logout'>Cerrar sesión</a><br/><br/>";
        echo "<nav>";
        echo "<a href=\"/\">Home</a>&nbsp";
        if ($_SESSION["perfil"] == "agente") {
            echo "&nbsp<a href='/multas/add'>Añadir Multas</a>";
        }
        if ($_SESSION["perfil"] == "conductor") {
            echo "&nbsp<a href='/multas/ver'>Multas</a>";
        }
        echo "</nav>";
        echo "<h3>Detalle de la multa</h3>";
    }
    ?>
    <form action="" method="post">

        <?php
        foreach ($data[0] as $key => $value) {
            echo "<label>IdMulta: <input type=\"text\" value =\"$value[id]\" disabled></label><br/>";
            echo "<label>Matricula: <input type=\"text\" value =\"$value[matricula]\" disabled></label><br/>";
            echo "<label>Conductor: <input type=\"text\" value =\"" . $data[1][0]["nombre"] . "\" disabled></label><br/>";
            echo "<label>Tipo de infracción: <input type=\"text\" value =\"" . $data[2][0]["tipo"] . "\" disabled></label><br/>";
            echo "<label>Descripción: <br/><textarea cols=\"30\" rows=\"10\" readonly>$value[descripcion]</textarea></label><br/>";
            echo "<label>Fecha: <input type=\"text\" value =\"$value[fecha]\" disabled></label><br/> ";
            echo "<label>Importe: <input type=\"text\" value =\"" . $data[3] . "\" disabled></label><br/>";
            echo "<label>Bonificacion: <input type=\"text\" value =\"" . $data[4] . "%\" disabled></label><br/>";
            echo "<input type=\"submit\" name=\"pagar\" value=\"Pagar\">";
        }
        ?>
    </form>
</body>

</html>