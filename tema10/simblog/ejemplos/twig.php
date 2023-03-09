<?php
/**
 * @author Hugo Vicente Peligro
 */
require_once("../vendor/autoload.php");

use App\Models\Blog;
use Laminas\Diactoros\Response\HtmlResponse;
use \Twig\Loader\FilesystemLoader;
use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;


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

$loader = new FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => true,
]);

$pepe = new HtmlResponse($twig->render("base.twig", [
    "Blogs" => Blog::all()
]
));
echo $pepe->getBody();


?>