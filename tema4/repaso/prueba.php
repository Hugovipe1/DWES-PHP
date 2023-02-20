<?php

setcookie("hola", "pepe", time()+3600);
setcookie("adios", "Juan", time()+3600);


if (isset($_POST["enviar"])) {
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, "pepe", time()-3600);
    }
    
}

$hola = array("pepe"=>array(1,2,3),
"JUAN"=>array(4,5)
array_push($hola["pepe"],10);
var_dump($hola);


?>

<form action="" method="POST">
    <input type="submit" name="enviar">

</form>
