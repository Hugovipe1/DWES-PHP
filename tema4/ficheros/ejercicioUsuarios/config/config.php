<?php
/**
 * @author Hugo Vicente Peligro
 */

define("DIRUPLOAD",'upload/');
define("MAXSIZE",30000000);
$extensiones = array("txt");
$formatoPermitido = array("text/plain");


 $formato = array("MYSQL","LINUX");
 $mes = date("n");
 $year = date("y");
 $yearDefecto = "";
 $grados = array("1º DAW A", "1º DAW B","2º DAW A","2º DAW B","1º ASIR A", "1º ASIR B","2º ASIR A");

 switch ($mes) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
    case 6:
    case 7:
    case 8:

        $yearDefecto = $year-1 ."/". $year;
        break;
    
    case 9:
    case 10:
    case 11:
    case 12:
        $yearDefecto = $year ."/". $year + 1;
 }
 $yearToShow = array();
 for ($i=0; $i < 5; $i++) { 
    $yearToShow[] = $year - $i ."/". $year - $i +1;
 }

 for ($i=1; $i < 5; $i++) { 
    $yearToShow[] = $year + $i ."/". $year + $i +1;
 }
asort($yearToShow);


?>