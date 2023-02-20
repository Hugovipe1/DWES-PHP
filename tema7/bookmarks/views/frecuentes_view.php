<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarks</title>
</head>

<body>
    <h1>Bookmarks</h1>
    <?php

    echo "<h3>Has iniciado sesion como $_SESSION[perfil]</h3> <a href=\"/bookmarks/logout\">Cerrar Sesión</a><br/><br/>";
    echo "<a href=\"/\">Home</a> <a href=\"\">Frecuentes</a>";


    echo "<h3>Bookmarks Frecuentes</h3>";
    
        echo "<form action=\"\" method=\"post\">";
        echo "<input type=\"submit\" value=\"$data[valueSubmit]\" name=\"marcarDesmarcarTodos\">";
        echo  "</form>";
        echo "<form action=\"\" method=\"post\">";
        foreach ($data["bmUrlFrecuentes"] as $key => $value) {
            if ($data["valueSubmit"] == "Desmarcar Todos") {
                echo "<input type=\"checkbox\" name=\"id[]\" checked value=\"$value[bm_url]\"> bm_url: <a href=\"#\">$value[bm_url]</a><br/>";
            } else {
                echo "<input type=\"checkbox\" name=\"id[]\" value=\"$value[bm_url]\"> bm_url: <a href=\"#\">$value[bm_url]</a><br/>";
            }
        }
        echo "<input type=\"submit\" value=\"Añadir favoritos\" name=\"añadirFavoritos\">";
        echo  "</form>";

    ?>

</body>

</html>