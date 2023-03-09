<?php
/**
 * @author Hugo Vicente Peligro
 */

require_once("../vendor/autoload.php");

use App\Models\Comment;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

define("DBHOST", $_ENV["DB_HOST"]);
define("DBUSER", $_ENV["DB_USER"]);
define("DBPASS", $_ENV["DB_PASSWD"]);
define("DBNAME", $_ENV["DB_NAME"]);
define("DBPORT", $_ENV["DB_PORT"]);

include "../data/datosblog.php";
include "../data/datoscomment.php";

// foreach ($blogs as $blog) {
//     $blog->set();
// }

// foreach ($comments as $comment) {
//     $comment->set();
// }
 
?>
