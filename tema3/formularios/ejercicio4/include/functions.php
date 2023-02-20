<?php

function sumaNumeros($array){
    $contador = 0;
    foreach ($array as $key => $value) {
        $contador += $value;
    }
    return $contador;
}
?>