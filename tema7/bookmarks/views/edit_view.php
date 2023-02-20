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
    <h1>Editar Bookmark</h1>
    <form action="" method="POST">

            <?php
                echo "bm_url nuevo a poner <input type=\"text\" name=\"bm_url\" value=\"$data[bm_url]\"><br/><br/>";
                echo "Descipcion nueva a poner <textarea name=\"descripcion\" id=\"\" cols=\"30\" rows=\"10\" placeholder=\"$data[descripcion]\"></textarea><br/><br/>";
            
            ?>

            <input type="submit" name="enviar" value="Confirmar bm_url">
        </form>
        
        <form action="" method="POST">
        <br/><input type="submit" name="inicio" value="Volver al inicio">
        </form>
</body>
</html>