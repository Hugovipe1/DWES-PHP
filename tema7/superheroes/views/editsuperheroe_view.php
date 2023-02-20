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
    <title>Edit Superhéroe</title>
</head>
<body>
    <h1>Editar Superhéroe</h1>
    <form action="" method="POST">

            <?php
            foreach ($data as $key => $value) {
                echo "Nombre nuevo a poner <input type=\"text\" name=\"nombre\" value=\"$value[nombre]\"><br/><br/>";
                echo "Velocidad nueva a poner <input type=\"text\" name=\"velocidad\" value=\"$value[velocidad]\"><br/><br/>";
            }
            ?>

            <input type="submit" name="enviar" value="Confirmar nombre">
        </form>
        <form action="" method="POST">
        <br/><input type="submit" name="inicio" value="Volver al inicio">
        </form>
</body>
</html>