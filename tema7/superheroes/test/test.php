<?php
/**
 * @author Hugo Vicente Peligro
 */

require("../vendor/autoload.php");

use Dotenv\Dotenv;
use App\Models\Superheroe;

$dotenv = Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

define("DBHOST", $_ENV["DB_HOST"]);
define("DBUSER",$_ENV["DB_USER"]) ;
define("DBPASS",$_ENV["DB_PASSWD"]) ;
define("DBNAME",$_ENV["DB_NAME"]) ;
define("DBPORT",$_ENV["DB_PORT"]) ;

$ObjSuperheroe = Superheroe::getInstancia();

$arrayNombre = $ObjSuperheroe->get("Batman");
foreach ($arrayNombre as $key => $value) {
    echo $value["nombre"];
}


$ObjSuperheroe->setNombre("Superman");
$ObjSuperheroe->setVelocidad(5);
$ObjSuperheroe->set();


/*$ObjSuperheroe->setId(1);
$ObjSuperheroe->setVelocidad("7");
$ObjSuperheroe->setNombre("Hulk");
$ObjSuperheroe->edit();

$ObjSuperheroe->delete(2)*/;
?>