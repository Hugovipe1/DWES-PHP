<?php

/**
 * @author Hugo Vicente Peligro
 */

require_once("../vendor/autoload.php");

use App\Controllers\AuthController;
use App\Controllers\RecetasController;
use App\Core\Router;
use App\Core\Bootstrap;
use Dotenv\Dotenv;

session_start();


$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

define("DBHOST", $_ENV["DB_HOST"]);
define("DBUSER", $_ENV["DB_USER"]);
define("DBPASS", $_ENV["DB_PASSWD"]);
define("DBNAME", $_ENV["DB_NAME"]);
define("DBPORT", $_ENV["DB_PORT"]);

$router = new Router();

if (!isset($_SESSION["perfil"])) {
    $_SESSION["perfil"] = "invitado";
}

if ($_SESSION["perfil"] != "invitado") {
    $tiempo = Bootstrap::obtenerTiempoInactividad();
    
    if(!isset($_SESSION["tiempo"])){
        $_SESSION["tiempo"] = time();
    }
    else if(time() - $_SESSION["tiempo"] > $tiempo[0]["tiempoinactividad"]){
        session_destroy();
        header("Location: /");
    } 
}

$router->add(array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action' => [RecetasController::class, 'IndexAction'],
    "perfiles" => ["invitado","Admin", "Collaborator", "User"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/logout$/',
    'action' => [AuthController::class, 'LogoutAction'],
    "perfiles" => ["Admin", "Collaborator", "User"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/recetas\/add$/',
    'action' => [RecetasController::class, 'addRecetaAction'],
    "perfiles" => ["Collaborator"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/recetas\/del\/[0-9]+$/',
    'action' => [RecetasController::class, 'deleteRecetaAction'],
    "perfiles" => ["Collaborator"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/recetas\/edit\/[0-9]+$/',
    'action' => [RecetasController::class, 'editRecetaAction'],
    "perfiles" => ["Collaborator"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/admin\/documento$/',
    'action' => [RecetasController::class, 'generarDocumentoPagoAction'],
    "perfiles" => ["Admin"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/recetas\/favoritas$/',
    'action' => [RecetasController::class, 'recetasFavoritasAction'],
    "perfiles" => ["User","Admin", "Collaborator"]
));


$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);
if ($route) {
    if (in_array($_SESSION["perfil"], $route["perfiles"])) {
        $controllerName = $route['action'][0];
        $actionName = $route['action'][1];
        $controller = new $controllerName;
        $controller->$actionName($request);
    }
    else{
        echo "No tienes permisos para acceder a esta ruta";
    }
    
} else {
    echo "No route";
}

?>
