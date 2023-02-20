<?php
/**
 * @author Hugo Vicente Peligro
 */
 function crearTabla($filas,$columnas, $nMinas){
    $tablero = array();
    for ($iniciaFila=0; $iniciaFila <= $filas -1 ; $iniciaFila++) { 
        for ($iniciaColumna=0; $iniciaColumna <= $columnas -1 ; $iniciaColumna++) { 
            $tablero[$iniciaFila][$iniciaColumna] = 0;
        }
    }
    for ($i=0; $i <= $nMinas - 1; $i++) { 
        do { //generamos las bombas.
            $filaBomba = rand(0,$filas - 1);
            $columnaBomba = rand(0, $columnas - 1);
        } while ($tablero[$filaBomba][$columnaBomba]== 9);
        $tablero[$filaBomba][$columnaBomba] = 9;
        for ($f= max(0,$filaBomba - 1); $f <= min($filas - 1, $filaBomba +1) ; $f++) { //recorremos las posiciones del array del alredededor de la bomba
            for ($c=max(0,$columnaBomba -1); $c <= min($columnas -1 , $columnaBomba + 1) ; $c++) { 
                if($tablero[$f][$c] != 9){
                    $tablero[$f][$c]++;
                }
            }
        }
    }
    return $tablero;   
 }

 /**function mostrarTabla($filas, $columnas, $tablero){
    for ($f=0; $f <= $filas - 1 ; $f++) {
        echo "<br/>";
        for ($c=0; $c <= $columnas-1; $c++) { 
            echo $tablero[$f][$c];
        }
    }
 }*/
 function mostrarTabla($tablero){
    foreach ($tablero as $key => $value) {
        foreach ($value as $key1 => $value1) {
            echo $value1;
        }
        echo "<br/>";
    }
 }

 function crearTablaVisible($filas, $columnas){
    $_SESSION["tableroMostrado"] = array(); 
    for ($iniciaFila=0; $iniciaFila <= $filas -1 ; $iniciaFila++) { 
        for ($iniciaColumna=0; $iniciaColumna <= $columnas -1 ; $iniciaColumna++) { 
            $_SESSION["tableroMostrado"][$iniciaFila][$iniciaColumna] = 0;
            
        }
    }
    
 }

 

 function clickCasillas($fila, $columna){
    if($_SESSION["tableroMostrado"][$fila][$columna] == 0) {   
        $_SESSION["tableroMostrado"][$fila][$columna] = 1;
        $_SESSION["contador"]++;
        if ($_SESSION["tablero"][$fila][$columna] == 9) {
            return 0;
        }
        else if ($_SESSION["contador"] == (NUMERO_FILAS * NUMERO_COLUMNAS) - N_MINAS) {
            return 1; // Si ganas!
        }
        else{
            if($_SESSION["tablero"][$fila][$columna] == 0){
                for ($fil= max(0,$fila - 1); $fil <= min(NUMERO_FILAS - 1, $fila +1) ; $fil++) { //recorremos las posiciones del array del alredededor de la bomba
                    for ($col=max(0,$columna -1); $col <= min(NUMERO_COLUMNAS -1 , $columna + 1) ; $col++) {
                        
                            if($_SESSION["tablero"][$fil][$col] == 0){
                                clickCasillas($fil,$col);
                            }
                            elseif ($_SESSION["tablero"][$fil][$col] > 0 && $_SESSION["tablero"][$fil][$col] < 9) {
                                $_SESSION["tableroMostrado"][$fil][$col] = 1;
                            }
                        
                    }
                }
            }
        }
        
    }
    
    
 }

 /*function mostrarTablero(){
    foreach ($_SESSION["tableroMostrado"] as $fila => $value) {
       foreach ($value as $columna => $value1) {
        
        if (intval($value1 == 1) || $value1 == "*") {
            if ($_SESSION["tablero"][$fila][$columna] == 0) {
                $_SESSION["tableroMostrado"][$fila][$columna] = "*";
            }
            elseif ($_SESSION["tablero"][$fila][$columna] > 0 && $_SESSION["tablero"][$fila][$columna] < 9) {
                $_SESSION["tableroMostrado"][$fila][$columna] = $_SESSION["tablero"][$fila][$columna]; 
            }
            else{
                $_SESSION["tableroMostrado"][$fila][$columna] = $_SESSION["tablero"][$fila][$columna];
            }

        }
        else{
            $_SESSION["tableroMostrado"][$fila][$columna] = "<a href=\"index.php?f=$fila&c=$columna\">0</a>";
            
        }
        echo $_SESSION["tableroMostrado"][$fila][$columna];
       }
       echo "<br/>";
    }

 }*/

 function mostrarTablero(){
    foreach ($_SESSION["tableroMostrado"] as $fila => $value) {
       foreach ($value as $columna => $value1) {
        
        if ($value1 == 1) {
            if ($_SESSION["tablero"][$fila][$columna] == 0) {
                echo "*";
            }
            elseif ($_SESSION["tablero"][$fila][$columna] > 0 && $_SESSION["tablero"][$fila][$columna] < 9) {
                echo $_SESSION["tablero"][$fila][$columna]; 
            }
            else{
                echo $_SESSION["tablero"][$fila][$columna];
            }

        }
        else{
            echo "<a href=\"index.php?f=$fila&c=$columna\">0</a>";
            
        }
       }
       echo "<br/>";
    }

 }

 
?>