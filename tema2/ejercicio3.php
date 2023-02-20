<?php
/**
 * Ejercicio 3: Cálculo del área y la circunferencia del círculo.
 * @author Hugo Vicente Peligro
 */
define("PI",3.14);
$radio = 10;
$area = PI * $radio*$radio;
$longitud = 2*PI*$radio;
echo "Área: $area "; //Expandiendo variables
echo "</br>";
echo "Longitud: ".$longitud; //Concatenando variables
echo '<svg viewBox="0 0 120 120" version="1.1"
xmlns="http://www.w3.org/2000/svg">
<circle cx="60" cy="60" r="'.$radio.'"/>
</svg>
</br>
';
?>

<a href="https://github.com/Hugovipe1/DWES-PHP/edit/main/tema2/ejercicio3.php" target="_blank">Ejercicio 3 </a>