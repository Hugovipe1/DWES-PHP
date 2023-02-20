<?php
/**
 * @author Hugo Vicente Peligro
 */

 function generaAbonados($num){
    $abonados = array();
    for ($i= 0;$i < $num; $i++) { 
        do {
            $numero = rand(1,400);
            
        } while (in_array($numero, $abonados));
        $abonados[$i] = $numero;
    }
    return $abonados;
 }

?>