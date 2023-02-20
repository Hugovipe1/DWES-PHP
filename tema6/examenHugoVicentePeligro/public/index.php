<?php
require("../vendor/autoload.php");

use App\Models\BookMarks;
use Dotenv\Dotenv;
use App\Models\Equipo;
use App\Models\Usuario;

session_start();
$dotenv = Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

define("DBHOST", $_ENV["DB_HOST"]);
define("DBUSER",$_ENV["DB_USER"]) ;
define("DBPASS",$_ENV["DB_PASSWD"]) ;
define("DBNAME",$_ENV["DB_NAME"]) ;
define("DBPORT",$_ENV["DB_PORT"]) ;

$mensaje = "";

if (!isset($_SESSION["marcarDesmarcarTodos"])) {
    $_SESSION["marcarDesmarcarTodos"] = false;
}
$marcarDesmarcarTodos = false;

if (!isset($_SESSION["perfil"])) {
    $_SESSION["perfil"] = "invitado";
    $_SESSION["contador"] = 0;
    $_SESSION["userErroneo"] = "";
}

if (isset($_POST["inicioSesion"])) {
    $objUsuario  = Usuario::getInstancia();
    $data = $objUsuario->existe($_POST["user"], $_POST["password"]);
    if ($data != null) {
        foreach ($data[0] as $key => $value) {
            if ($key == "nombre") { // Tambien se puede poner switch
                $objUsuario->setNombre($value);
            }
            if ($key == "user") {
                $objUsuario->setUser($value);
            }
            if ($key == "psw") {
                $objUsuario->setPsw($value);
            }
            if ($key == "email") {
                $objUsuario->setEmail($value);
            }
            if ($key == "perfil") {
                $objUsuario->setPerfil($value);
            }
            if ($key == "bloqueado") {
                $objUsuario->setBloqueado($value);
            }
            if ($key == "id") {
                $objUsuario->setId($value);
            }
        }
        if ($objUsuario->getBloqueado() == 1) {
            $mensaje = "Usuario bloqueado";
        }
        else {
            if ($_SESSION["userErroneo"] == $_POST["user"]) { // Si el usuario que era erroneo es correcto reiniciamos contador y userErroneo.
                $_SESSION["contador"] = 0;
                $_SESSION["userErroneo"] = "";
            }
            $_SESSION["perfil"] = $objUsuario->getPerfil();
            $_SESSION["idUsuario"] = $objUsuario->getId();
            
        }
    }
    else { // Si no es correcta la contraseña o el usuario
    
        if ($objUsuario->existeUsuario($_POST["user"])) {
            // Si existe el usuario pero la contraseña no es correcta
            if ($_SESSION["userErroneo"] != $_POST["user"]) {
                $_SESSION["userErroneo"] = $_POST["user"];
                $_SESSION["contador"] = 1;
            }
            elseif ($_SESSION["userErroneo"] == $_POST["user"]) {
                $_SESSION["contador"]++;
            }
            $mensaje =  "Usuario o contraseña incorrectos";
            
            if (($_SESSION["userErroneo"] == $_POST["user"]) && ($_SESSION["contador"] == 3)) {
                $objUsuario->bloquear($_SESSION["userErroneo"]);
                $mensaje =  "Usuario bloqueado has superado el numero de intentos.";
            }
            
        }
        else { //Si no existe el usuario en la base de datos
            $mensaje =  "Usuario o contraseña incorrectos";
        }        
    }
    
          
}


if (isset($_POST["desbloquear"])) {
    $objUsuario  = Usuario::getInstancia();
    $objUsuario->desbloquear($_POST["id"]);
}
if ($_SESSION["perfil"] == "user") {
    $objBookMarks = BookMarks::getInstancia();
    $dataBookMarks = $objBookMarks->obtenerEnlace($_SESSION["idUsuario"]);
}
elseif ($_SESSION["perfil"] == "admin") {
    $objUsuario  = Usuario::getInstancia();
    $usersBlockeds = $objUsuario->getBloqueados();
}

if (isset($_POST["marcarDesmarcarTodos"])) {
    $_SESSION["marcarDesmarcarTodos"] ? $_SESSION["marcarDesmarcarTodos"] = false : $_SESSION["marcarDesmarcarTodos"] = true;
}

$_SESSION["marcarDesmarcarTodos"] ? $valueSubmit = "Desmarcar Todos" : $valueSubmit = "Marcar Todos" ;
    

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Hugo Vicente Peligro</title>
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
    echo $mensaje;
    }
    
    if ($_SESSION["perfil"] != "invitado") {
        
        echo "<h3>Has iniciado sesion como $_SESSION[perfil]</h3> <a href=\"../cierresesion.php\">Cerrar Sesión</a>";

    if ($_SESSION["perfil"] == "user") {
    ?>
        <form action="add.php" method="POST">
            <label>Añadir BookMarks: </label><input type="submit" name="add" value="add"><br/>
        </form>
    <?php
        foreach ($dataBookMarks as $key => $value) {
            echo "<p>bm_url: <a href=\"#\">$value[bm_url]</a>; descripción: $value[descripcion]   <a href=\"delete.php?idUrl=$value[id]\">Delete</a></p>";
        }
    }
    

    if ($_SESSION["perfil"] == "admin") {

        echo "<form action=\"\" method=\"POST\">";
        echo "<input type=\"submit\" name=\"marcarDesmarcarTodos\" value=\"$valueSubmit\">";
        echo"</form>";
        echo "<form action=\"\"  method=\"POST\">";
        foreach ($usersBlockeds as $key1 => $value1) {
            if ($_SESSION["marcarDesmarcarTodos"]) {
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