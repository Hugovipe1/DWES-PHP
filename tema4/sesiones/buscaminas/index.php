<?php
/**
 * @author Hugo Vicente Peligro
 */
include("./config/config.php");
include("./lib/functions.php");
 session_start();
if (!isset($_SESSION["tablero"])) {
    $_SESSION["tablero"] = crearTabla(NUMERO_FILAS,NUMERO_COLUMNAS,N_MINAS);
    crearTablaVisible(NUMERO_FILAS,NUMERO_COLUMNAS);
    $_SESSION["contador"] = 0;
}

mostrarTabla($_SESSION["tablero"]); // Solución
echo "</br>";

if(isset($_GET["f"])){
    if (isset($_GET["c"])) {
        $fila = $_GET["f"];
        $columna = $_GET["c"];
        
        $resultado = clickCasillas($fila, $columna);
        
        if ($resultado == 1) {
            echo "Has ganado <br/>";
            
        }
        if ($resultado === 0) {
            echo "Has perdido <br/>";
            
        }
        
        
        
    }
}
mostrarTablero();
echo "<br/>";
echo "<a href=\"./cierreSesion.php\"> Reiniciar</a>";
