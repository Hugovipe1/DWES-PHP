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
    <title>Edit Receta</title>
</head>
<body>
    <h1>CocinaSaludable</h1>
    <h2>Edit Receta</h2>
    <form action="" method="POST" enctype="multipart/form-data">

            <?php
                echo "Titulo nuevo a poner <input type=\"text\" name=\"titulo\" value=\"$data[titulo]\"><br/><br/>";
                echo "Ingredientes nueva a poner <input type=\"text\" name=\"ingredientes\" value=\"$data[ingredientes]\"><br/><br/>";
                echo "Elaboracion nueva a poner <input type=\"text\" name=\"elaboracion\" value=\"$data[elaboracion]\"><br/><br/>";
                echo "Etiquetas nueva a poner <input type=\"text\" name=\"etiquetas\" value=\"$data[etiquetas]\"><br/><br/>";
                echo "Poner publica o privada la receta <input type=\"number\" name=\"publica\" value=\"$data[publica]\"><br/><br/>";
                echo "Imagen nueva a poner <input type=\"file\" name=\"file\" value=\"$data[imagen]\"><br/><br/>";
                echo "<input type=\"hidden\" name=\"imagenBD\" value=\"$data[imagen]\">";  
            ?>

            <input type="submit" name="enviar" value="Confirmar receta">
        </form>
        
        <form action="" method="POST">
        <br/><input type="submit" name="inicio" value="Volver al inicio">
        </form>
</body>
</html>
