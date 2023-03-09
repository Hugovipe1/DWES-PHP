<?php
/**
 * @author Hugo Vicente Peligro
 */

require_once("../vendor/autoload.php");

use App\Core\Router;
use App\Core\Bootstrap;
use Dotenv\Dotenv;
use App\Controllers\MultasController;
use App\Controllers\AuthController;

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

$router->add(array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action' => [MultasController::class, 'IndexAction'],
    "perfiles" => ["invitado","admin", "agente", "conductor"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/logout$/',
    'action' => [AuthController::class, 'LogoutAction'],
    "perfiles" => ["admin", "agente", "conductor"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/multas\/ver$/',
    'action' => [MultasController::class, 'ListadoMultasAction'],
    "perfiles" => ["conductor"]
));


$router->add(array(
    'name' => 'home',
    'path' => '/^\/multas\/add$/',
    'action' => [MultasController::class, 'addMultaAction'],
    "perfiles" => ["agente"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/multas\/pagar\/[0-9]+$/',
    'action' => [MultasController::class, 'pagarMultaAction'],
    "perfiles" => ["conductor"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/multas\/listado$/',
    'action' => [MultasController::class, 'listadoMultasAgenteAction'],
    "perfiles" => ["agente"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/conductores\/listado$/',
    'action' => [MultasController::class, 'ListadoConductoresAction'],
    "perfiles" => ["admin"]
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