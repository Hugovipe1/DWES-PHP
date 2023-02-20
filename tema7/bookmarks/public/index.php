<?php
require_once("../vendor/autoload.php");

use App\Controllers\BookMarksController;
use App\Controllers\AuthController;
use App\Core\Router;

session_start();
if (!isset($_SESSION["perfil"])) {
    $_SESSION["perfil"] = "invitado";
    $_SESSION["contador"] = 0;
    $_SESSION["userErroneo"] = "";
}
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

define("DBHOST", $_ENV["DB_HOST"]);
define("DBUSER", $_ENV["DB_USER"]);
define("DBPASS", $_ENV["DB_PASSWD"]);
define("DBNAME", $_ENV["DB_NAME"]);
define("DBPORT", $_ENV["DB_PORT"]);

$router = new Router();

$router->add(array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action' => [BookMarksController::class, 'IndexAction'],
    "perfiles" => ["invitado","user", "admin"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/bookmarks\/frecuentes$/',
    'action' => [BookMarksController::class, 'FrecuentesAction'],
    "perfiles" => ["user"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/bookmarks\/logout$/',
    'action' => [AuthController::class, 'LogoutAction'],
    "perfiles" => ["user", "admin"]
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/bookmarks\/add$/',
    'action' => [BookMarksController::class, 'AddAction'],
    "perfiles" => ["user"] // Perfiles que pueden acceder a la ruta
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/bookmarks\/del\/[0-9]*$/',
    'action' => [BookMarksController::class, 'DeleteAction'],
    "perfiles" => ["user"] // Perfiles que pueden acceder a la ruta
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/bookmarks\/edit\/[0-9]*$/',
    'action' => [BookMarksController::class, 'EditAction'],
    "perfiles" => ["user"] // Perfiles que pueden acceder a la ruta
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
