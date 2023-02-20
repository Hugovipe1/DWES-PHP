<?php
/**
 * Tema 3 
 * Ejercicio 2 Carga en variables mes y año e indica el número de días del mes. Utiliza la estructura de control switch;
 * @author Hugo Vicente Peligro
 */
    $month = 2;
    $year = 2020;
    $nDias;
    $bisiesto = false;
    if(($year %4 == 0 && $year % 100 != 0) || $year %400 == 0){
        $bisiesto = true;
    }

if ($bisiesto){
    switch ($month) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            $nDias = 31;
            echo"Tiene $nDias";
            break;

        case 2:
            $nDias = 28;
            echo"Tiene $nDias";
            break;
        case 4:
        case 6:
        case 9:
        case 11: 
            $nDias = 30;
            echo"Tiene $nDias";
            break;
        
    }
}
if(!$bisiesto){
    switch ($month) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            $nDias = 31;
            echo"Tiene $nDias";
            break;

        case 2:
            $nDias = 29;
            echo"Tiene $nDias";
            break;
        case 4:
        case 6:
        case 9:
        case 11: 
            $nDias = 30;
            echo"Tiene $nDias";
            break;
        
    }
}
    


?>