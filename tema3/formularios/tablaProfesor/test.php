<?php
include("include/functions.php");
$aTest = array(
    array("f" => 3, "c" => 5),
    array("f" => 4, "c" => 7),
    array("f" => 6, "c" => 9)

);
if(existeCoordenada(3,5,$aTest)){
    echo "existe 3,5";
}

?>