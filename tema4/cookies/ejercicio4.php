<?php
/**
 * @author Hugo Vicente Peligro
 */
//Incluir en vuestro servidor un contador que indique al usuario el número de veces que ha visitado el sitio. 
setcookie("contador",0,time()+3600);
if (isset($_COOKIE["contador"])) {
    $contador = $_COOKIE["contador"];
    $contador++;
    setcookie("contador",$contador,time()+3600);
    echo "Has visitado esta página ".$contador." veces";
}
else {
    echo"Hola";
    echo "Has visitado esta página 0 veces";
} 


?>
