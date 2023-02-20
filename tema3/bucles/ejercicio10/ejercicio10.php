<?php
/**
 * @author Hugo VIcente Peligro
 * Ejercicio 10
 * Dado el mes y año almacenados en variables, escribir un programa que muestre el calendario mensual 
 * correspondiente. Marcar el día actual en verde y los festivos en rojo.
 */
$year = date("Y");
$diasMes = date("j");
$mes = date("F");

$diasSemana = array("lunes","martes","miércoles","jueves","viernes","sábado","domingo");
echo"<table border= 2px>";
echo"<tr>";
for ($i = 0; $i < 7; $i++){
    echo"<th>$diasSemana[$i]</th>";
}
echo"</tr>";
echo"</table>";
?>
