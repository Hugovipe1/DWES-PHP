<?php
/**
 *@author Hugo Vicente Peligro 
 */

require_once("../vendor/autoload.php");
use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;
use App\Models\Blog;

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



if (isset($_POST['enviar'])) {
    $blog = Blog::create([
        'title' => $_POST['title'],
        'blog' => $_POST['blog'],
        'image' => $_POST['image'],
        'author' => $_POST['author'],
        'tags' => $_POST['tags'],
    ]);
    var_dump($blog);
    $blog->save();
    header("Location: /");
    // $blog = new Blog();
    // $blog->title = $_POST['title'];
    // $blog->blog = $_POST['blog'];
    // $blog->image = $_POST['image'];
    // $blog->author = $_POST['author'];
    // $blog->tags = $_POST['tags'];
    // $mFormat = "Y/m/d H:i";
    // $update = new \DateTime();
    // $blog->tags = $update->format($mFormat);
    // $blog->save();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        Title<input type="text" name="title">
        Blog<input type="text" name="blog">
        Image<input type="text" name="image">
        Author<input type="text" name="author">
        Tags<input type="text" name="tags">
        <input type="submit" value="Submit" name="enviar">
    </form>
    
</body>
</html>