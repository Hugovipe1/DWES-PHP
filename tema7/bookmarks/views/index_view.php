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
    if ($_SESSION["perfil"] == "invitado") {
    ?> 
    <form action="" method="POST">
            Usuario <input type="text" name="user">
            Contraseña <input type="password" name="password">
            <input type="submit" name="inicioSesion" value="Iniciar Sesion"><br/>
    </form>
    <?php 
    echo $data["mensaje"];
    }
    
    if ($_SESSION["perfil"] != "invitado") {
        
        echo "<h3>Has iniciado sesion como $_SESSION[perfil]</h3> <a href=\"bookmarks/logout\">Cerrar Sesión</a><br/><br/>";
        echo "<a href=\"#\">Home</a> <a href=\"/bookmarks/frecuentes\">Frecuentes</a>";
        if ($_SESSION["perfil"] == "user") {
        ?>
        <form action="bookmarks/add" method="POST">
                <label>Añadir BookMarks: </label><input type="submit" name="add" value="add"><br/>
            </form>
        <?php
            foreach ($data["dataBookMarks"] as $key => $value) {
                echo "<p>bm_url: <a href=\"#\">$value[bm_url]</a>; descripción: $value[descripcion]  <a href=\"bookmarks/edit/$value[id]\">Edit</a> <a href=\"bookmarks/del/$value[id]\">Delete</a></p>";
            }
        }
        
        if ($_SESSION["perfil"] == "admin") {

            echo "<form action=\"\" method=\"POST\">";
            echo "<input type=\"submit\" name=\"marcarDesmarcarTodos\" value=\"$data[valueSubmit]\">";
            echo"</form>";
            echo "<form action=\"\"  method=\"POST\">";
            foreach ($data["usersBlockeds"] as $key1 => $value1) {
                if ($data["valueSubmit"] == "Desmarcar Todos") {
                    echo "<input type=\"checkbox\" name=\"id[]\" checked value=\"$value1[id]\"> Nombre: $value1[nombre]; User: $value1[user]; Email: $value1[email]; Bloqueado: $value1[bloqueado]<br/>";
                }
                else{
                    echo "<input type=\"checkbox\" name=\"id[]\" value=\"$value1[id]\"> Nombre: $value1[nombre]; User: $value1[user]; Email: $value1[email]; Bloqueado: $value1[bloqueado]<br/>";

                }
                
            }
            echo "<input type=\"submit\" name=\"desbloquear\" value=\"Desbloquear\">";
            echo "</form>";
        }
    }
    ?>

</body>
</html>