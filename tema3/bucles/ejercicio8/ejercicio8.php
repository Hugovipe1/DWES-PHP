<?php
/**
 * @author Hugo Vicente Peligro
 * Ejercicio 8 Tablas de multiplicar del 1 al 10. Aplicar estilos en filas/columnas
 */
const N = 10;
const M = 10;

echo"<link rel=\"stylesheet\" href=\"./style.css\">";
echo"<table border =\"2px\">";
echo"<tr>";
for ($c=1; $c <= N ; $c++) { 
    echo"<th id=\"cabecera\"> $c </th>";
}
echo"</tr>";
 for ($i=1; $i <= N ; $i++) {
    echo"<tr>";
   for ($n=1; $n <= M ; $n++) {
    echo"<td id=\"resultado\">".$i*$n." </td>";   
   }
   echo"</tr>"; 
 }
 echo"</table>";
?>