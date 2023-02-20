<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Añadir bookmarks</title>
    </head>

    <body>
        <h1>Bookmarks</h1>
        <?php
        if ($data["procesaFormulario"]) {
        ?>
            <form action="" method="POST">
                <input type="submit" name="inicio" value="Volver al inicio"><br/><br/>
            </form>
            <form action="" method="POST">
                <label>URL </label><input type="text" name="nombre" placeholder="url"><br/>
                <br/><label>Descripción </label><textarea name="descripcion" id="" cols="30" rows="10" placeholder="Descripción"></textarea><br/>
                <br/><input type="submit" name="enviar" value="Añadir Bookmarks"><br/>
            </form>
        <?php
        }
        ?>
        
    </body>

    </html>