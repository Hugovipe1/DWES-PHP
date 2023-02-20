<?php
require_once("../vendor/autoload.php");

use App\Controllers\ContactosController;
use App\Controllers\AuthController;
use App\Core\Router;
use App\Core\Bootstrap;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

Bootstrap::variablesEnv();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

$methord = $_SERVER['REQUEST_METHOD'];
if($methord == "OPTIONS"){
    die();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri  = explode( '/', $request );
$userId = null;
if (isset($uri[2]) && is_numeric($uri[2])) {
    $userId = (int) $uri[2];
}


if($request == "/login"){
    $auth = new AuthController();
    if($auth->existeUsuario()){
        $token = $auth->generarToken();
        header("HTTP/1.1 200 OK");
        echo json_encode($token);
        exit();
    }
    else{
        exit(http_response_code(401));
    }
}

if ($request == "/registrarse") {
    $auth = new AuthController();
    if($auth->registrarUsuario()){
        exit(http_response_code(200));
    }
    else{
        exit(http_response_code(401));
    }
}

if(!isset($_SERVER["HTTP_AUTHORIZATION"])){
    exit(http_response_code(401));
}
$autHeader = $_SERVER["HTTP_AUTHORIZATION"];
$jwt = explode(" ", $autHeader)[1];

if($jwt){
    try {
        // En el decode podemos sacar datos del token como el perfil y ponerlo en una variable de SESSION
        $decoded = JWT::decode($jwt, new Key(KEY,"HS256"));
    } catch (\Exception $e) {
        echo $e->getMessage();
        exit(http_response_code(401));

    }
}


$router = new Router();
$router->add(array(
    'name' => 'home',
    'path' => '/^\/contactos$/', // devuelve todos los contactos método GET
    'action' => [ContactosController::class],
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/contactos\/[0-9]*$/', //devuelve un contacto por su id método GET
    'action' => [ContactosController::class],
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/contacto$/', //añadir un contacto método POST
    'action' => [ContactosController::class],
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/contacto\/[0-9]*$/',
    'action' => [ContactosController::class], //modificar un contacto método PUT
));

$router->add(array(
    'name' => 'home',
    'path' => '/^\/contactoDel\/[0-9]*$/', //borrar contactos método DELETE
    'action' => [ContactosController::class],
));


$request = $_SERVER['REQUEST_URI'];

$route = $router->match($request);
if ($route) {
    $controllerName = $route['action'][0];
    $controller = new $controllerName($requestMethod, $userId);
} else {
    echo "No route";
}
