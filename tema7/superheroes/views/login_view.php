<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php
        if ($_SESSION["perfil"] == "invitado") {
        
    ?>
    <form action="" method="post">
        <label>Usuario: <input type="text" name="usuario"></label><br/><br/>
        <label>Password: <input type="password" name="passwd"></label>
        <input type="submit" name="enviar" value="Enviar"><br/><br/>
    </form>
    <?php
        }
    ?>
</body>
</html>