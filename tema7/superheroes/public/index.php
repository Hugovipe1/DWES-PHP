<?php
require_once("../vendor/autoload.php");

use App\Controllers\SuperheroesController;
use App\Controllers\AuthController;
use App\Core\Router;

session_start();

    use Dotenv\Dotenv;
    $dotenv = Dotenv::createImmutable(__DIR__. "/../");
    $dotenv->load();

    define("DBHOST", $_ENV["DB_HOST"]);
    define("DBUSER",$_ENV["DB_USER"]) ;
    define("DBPASS",$_ENV["DB_PASSWD"]) ;
    define("DBNAME",$_ENV["DB_NAME"]) ;
    define("DBPORT",$_ENV["DB_PORT"]) ;

$router = new Router();

$router->add(array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action' => [SuperheroesController::class, 'IndexAction']));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/superheroes\/add$/',
    'action' => [SuperheroesController::class, 'AddAction']));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/superheroes\/del\/[0-9]+$/',
    'action' => [SuperheroesController::class, 'DelAction']));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/superheroes\/edit\/[0-9]+$/',
    'action' => [SuperheroesController::class, 'EditAction']));

$router->add(array(
        'name' => 'home',
        'path' => '/^\/superheroes\/logout$/',
        'action' => [AuthController::class, 'LogoutAction']));

    
$request = $_SERVER['REQUEST_URI'];

$route = $router->match($request);
if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
}
