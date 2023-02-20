<?php
/**
 * @author Hugo Vicente Peligro
 * Mejora calendario con un array de los días festivos: colores diferentes, nacionales, comunidad, locales.
 */
 $diasSemana = array("Lunes","Martes","Miércoles", "Jueves", "Viernes", "Sabado", "Domingo");
 $festivos = array("nacionales" =>
                                    array(
                                            array("dia" => 1, "mes" =>1),
                                            array("dia"=> 6, "mes" => 1),
                                            array("dia"=> 15, "mes" => 8),
                                            array("dia" => 12, "mes"=> 10),
                                            array("dia"=> 1, "mes" => 11),
                                            array("dia"=> 6, "mes" => 12),
                                            array("dia"=> 8, "mes" => 12),
                                            array("dia"=> 25, "mes" => 12)

                                    ),
                    "comunidad" => array(
                                            array("dia" => 28, "mes" => 2),
                                            array("dia"=> 2, "mes" => 5)
                                            

                                    ),

                    "locales" => array(
                                            array("dia"=> 8, "mes" => 9),
                                            array("dia"=> 24, "mes" => 10)

                                    )
);
 $diaActual = date("j");
 $month = 10;
 $year = 2022;
 $easter = easter_days($year);
 echo"$easter";
$diasMes = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$mesActual = date("n");
$month_start = date("w", mktime(0, 0, 0, $month, 1, $year));
$diaMes =1;
$contador = 0;
$tipoFestivo = "";
$class;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Horario</title>
</head>
<body>
<?php

 echo"<table border=\"2px\">";
 //cabecera
 echo"<tr>";
 foreach($diasSemana as $clave =>$valor){
     echo"<th>$valor</th>";
 }
 echo"</tr>";
 echo"<tr>";
 
 //Imprimir los dias en blanco
 for($x =0; $x < $month_start ; $x++){  
     echo"<td> </td>";  
 }
 
 for ($i=1; $i <= $diasMes; $i++) {

     foreach($festivos as $clave => $valor){
         foreach ($valor as $clave1 => $valor1) {
            
            if($month == $valor1["mes"] && $i == $valor1["dia"]){
                 $tipoFestivo = $clave;
             }
         }
     }
     
    if($i == $diaActual){
        $tipoFestivo = "diaActual";
    }
     $x++;
     
     switch($tipoFestivo){
        
         case "nacionales":
            $class = "nacional";
             break;
         case "comunidad":
            $class = "comunidad";
             break;
         
         case "locales":
            $class = "local";
             break;

        case "diaActual":
            $class = "diaActual";
             break;
            
         default:
             if ($x == 7) {
                $class = "domingo";
             }else {
                $class = "";
             }
 
     }
     if($class == ""){
        echo"<td>$i</td>";
     }
     else {
        echo"<td><span class = \"$class\">$i</span></td>";
     }
     
     $tipoFestivo = "";
     
     if($x % 7 == 0){
         echo"</tr>";
         $x = 0;
         echo"<tr>";
     }  
 }
     
 
 
 echo"<table/>";



?>
</body>
</html>