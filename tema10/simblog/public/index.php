<?php
require_once("../vendor/autoload.php");

use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;
use App\Models\Blog;
use Laminas\Diactoros\ServerRequestFactory;
use Aura\Router\RouterContainer;
use App\Controllers\BlogsController;
use App\Controllers\AuthController;
use App\Controllers\CommentController;

session_start();


$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$capsule  = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => $_ENV["DB_HOST"],
    'database' => $_ENV["DB_NAME"],
    'username' => $_ENV["DB_USER"],
    'password' => $_ENV["DB_PASSWD"],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();



$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);
$ruta = $request->getUri()->getPath();
$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$map->get("addBlog", "/blogs/add", [
    "controller" => "App\Controllers\BlogsController",
    "action" => "getAddBlogAction",
    "auth" => true
]);

$map->post("saveBlog", "/blogs/add", [
    "controller" => "App\Controllers\BlogsController",
    "action" => "getAddBlogAction",
    "auth" => true
]);

$map->get("index", "/", [
    "controller" => "App\Controllers\IndexController",
    "action" => "indexAction"
]);

$map->get("showBlog", "/blog/{id}", [
    "controller" => "App\Controllers\BlogsController",
    "action" => "showBlogAction"
])->tokens(["id" => "\d+"]);

$map->post("addComment", "/comment/save", [
    "controller" => "App\Controllers\CommentController",
    "action" => "postCommentAction"
]);

$map->get("contact", "/contact", [
    "controller" => "App\Controllers\BlogsController",
    "action" => "contactAction"
]);

$map->post("contactPost", "/contact", [
    "controller" => "App\Controllers\BlogsController",
    "action" => "contactAction"
]);

$map->get("addUser", "/users/add", [
    "controller" => "App\Controllers\UsersController",
    "action" => "getAddUser"
]);

$map->post("postaddUser", "/users/add", [
    "controller" => "App\Controllers\UsersController",
    "action" => "postAddUser"
]);

$map->get("loginForm", "/login", [
    "controller" => "App\Controllers\AuthController",
    "action" => "getLogin"
]);

$map->post("loginFormPost", "/login", [
    "controller" => "App\Controllers\AuthController",
    "action" => "postLogin"
]);

$map->get("adminLogout", "/logout", [
    "controller" => "App\Controllers\AuthController",
    "action" => "getLogout",
    "auth" => true
]);

$map->get("admin", "/admin", [
    "controller" => "App\Controllers\AdminController",
    "action" => "getAdmin",
    "auth" => true
]);

$map->post("adminPost", "/admin", [
    "controller" => "App\Controllers\AdminController",
    "action" => "getAdmin",
    "auth" => true
]);


$map->get("about", "/about", [
    "controller" => "App\Controllers\BlogsController",
    "action" => "aboutAction"
]);



$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);




if (!$route) {
    echo "No route";
} else {
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];

    $needsAuth = $handlerData['auth'] ?? false;
    $sessionUserId = $_SESSION['userId'] ?? null;
    if ($needsAuth && !$sessionUserId) {
        header('Location: /login');
    } else {
        $controller = new $controllerName;
        $response = $controller->$actionName($request);
        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }
        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }
}


