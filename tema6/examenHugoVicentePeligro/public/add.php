<?php
require("../vendor/autoload.php");

use App\Models\DBAbstractModel;
use App\Models\BookMarks;
use Dotenv\Dotenv;

session_start();
if (!isset($_SESSION["perfil"]) && $_SESSION["perfil"] != "admin" && $_SESSION["perfil"] != "user") {
    header("Location: index.php");
}else{
    $dotenv = Dotenv::createImmutable(__DIR__. "/../");
    $dotenv->load();

    define("DBHOST", $_ENV["DB_HOST"]);
    define("DBUSER",$_ENV["DB_USER"]) ;
    define("DBPASS",$_ENV["DB_PASSWD"]) ;
    define("DBNAME",$_ENV["DB_NAME"]) ;
    define("DBPORT",$_ENV["DB_PORT"]) ;
    $procesaFormulario = false;
    if (isset($_POST["add"])) {
        $procesaFormulario = true;
    }
    if (isset($_POST["enviar"])) {
        $objBookmarks = BookMarks::getInstancia();
        $objBookmarks->setbmUrl($_POST["nombre"]);
        $objBookmarks->setDescripcion($_POST["descripcion"]);
        $objBookmarks->setIdUsuario($_SESSION["idUsuario"]);
        $objBookmarks->set();
        header("Location: index.php");
    }
    if (isset($_POST["inicio"])) {
        header("Location: index.php");
    }
    ?>
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
        if ($procesaFormulario) {
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
<?php
}
?>
