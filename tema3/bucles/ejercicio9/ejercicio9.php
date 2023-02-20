<?php
/**
 * @author Hugo Vicente Peligro
 * Ejercicio 9 Mostrar paleta de colores. Utilizar una tabla que muestre el color y el valor hexadecimal que le 
 * corresponde. Cada celda será un enlace a una página que mostrará un fondo de pantalla con el color 
 * seleccionado. ¿Puedes hacerlo con los conocimientos que tienes?
 */

 const NUM_MAX = 255;
 $color;
 echo"<table border=\"2px\">";
 for ($r=0; $r <= NUM_MAX; $r+=30) { 
    echo"<tr>";
    for ($g=0; $g <=NUM_MAX; $g+=30) { 
        echo"<tr>";
        for ($b=0; $b <= NUM_MAX; $b+=30) { 
            $color = fromRGB($r,$g,$b);
            $colorMod = substr($color,1);
            echo"<td style=\"background-color: $color;\">";
            echo"<a href=\"ejercicio9Fondo.php?color=$colorMod\">$color</a>";
            echo"</td>";
        }
        echo"</tr>";
    }
    echo"</tr>";
 }
 echo"</table>";

 function fromRGB($R, $G, $B)
{

    $R = dechex($R);
    if (strlen($R)<2)
    $R = '0'.$R;

    $G = dechex($G);
    if (strlen($G)<2)
    $G = '0'.$G;

    $B = dechex($B);
    if (strlen($B)<2)
    $B = '0'.$B;

    return '#' . $R . $G . $B;
}
?>