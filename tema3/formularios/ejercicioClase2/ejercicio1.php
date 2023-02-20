<?php
/**
 * Ejercicio donde creamos formulario a través del array
 * @author Hugo Vicente Peligro
 */
$datosAlumnos = array("nombre" => "text", "apellidos" => "text", "curso" => "text");
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
    <form action="proceso_ejercicio.php" method="post">
    <?php
    foreach ($datosAlumnos as $key => $value) {
        echo"<p>";
        echo"<input name= \"$key\" type = $value>";
        echo"</p>";
    }
    ?>
    <input type="submit"  name="send" value="enviar">
    </form>
</body>
</html>