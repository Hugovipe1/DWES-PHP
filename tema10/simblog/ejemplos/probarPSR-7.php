<?php
require_once("../vendor/autoload.php");

use Laminas\Diactoros\ServerRequestFactory;
use Aura\Router\RouterContainer;


$request = ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);
$ruta = $request->getUri()->getPath();
var_dump($ruta);
$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
$map->get("addBlog", $ruta, function(){
    echo "hola";
    header("Location: /addBlog.php");
});
$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);


if(!$route){
    echo "No route";
}else{
    $handlerData = $route->handler;
    $handlerData();
}
?>