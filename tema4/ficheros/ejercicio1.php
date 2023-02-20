<?php
/**
 * @author Hugo Vicente Peligro
 */

$file = fopen("poema.txt","r");
$file1 = fopen("poemaMayuscula.txt", "w");
while (!feof($file)) {
    $linea = fgets($file);
    $text = strtoupper($linea);
    fwrite($file1,$text);
}
fclose($file);



?>