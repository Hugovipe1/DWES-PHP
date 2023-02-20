<?php
require("../vendor/autoload.php");

use App\Models\BookMarks;
use Dotenv\Dotenv;
session_start();
if(!isset($_SESSION["perfil"]) && $_SESSION["perfil"] != "admin" && $_SESSION["perfil"] != "user"){
    header("Location: index.php");
}
else{
    $autorizado = false;
    $dotenv = Dotenv::createImmutable(__DIR__. "/../");
    $dotenv->load();

    define("DBHOST", $_ENV["DB_HOST"]);
    define("DBUSER",$_ENV["DB_USER"]) ;
    define("DBPASS",$_ENV["DB_PASSWD"]) ;
    define("DBNAME",$_ENV["DB_NAME"]) ;
    define("DBPORT",$_ENV["DB_PORT"]) ;
    $id = $_GET["idUrl"];
    $objBookMarks = BookMarks::getInstancia();
    $data = $objBookMarks->get();
    foreach ($data as $key => $value) {
        if($value["id"] == $id){//Si el id de la url coincide con el id de la url que queremos borrar
            if ($value["idUsuario"] == $_SESSION["idUsuario"]) {
               $autorizado = true;
            }
        }
    }
    if ($autorizado) {
        $objBookMarks->delete($id);
        header("Location: index.php");
    }
    else{
        header("Location: index.php");
    }
}
?>