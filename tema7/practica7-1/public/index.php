<?php
require_once("../app/Config/parametros.php");
require_once("../vendor/autoload.php");

use App\Controllers\IndexController;
use App\Controllers\NumerosController;
use App\Core\Router;


$router = new Router();
$router->add(array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action' => [IndexController::class, 'IndexAction']
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/saludo\/[a-z]*$/',
    'action' => [IndexController::class, 'SaludaAction']
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/numeros$/',
    'action' => [NumerosController::class, 'NumerosAction']
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/numeros\/[0-9]*$/',
    'action' => [NumerosController::class, 'NumerosContadosAction']
));


$request = str_replace(DIRBASEURL, '', $_SERVER['REQUEST_URI']);
$route = $router->match($request);
if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
}
