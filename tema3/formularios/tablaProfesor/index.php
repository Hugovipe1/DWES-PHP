<?php
include("config/config.php");
include("include/functions.php");

//Cargamos valores

$valoresActuales = array();
/*Estructura del array valoresActuales
$valoresActuales = 
);

*/

$numerosAleatorios = array();
/*
Estructura del array numerosAleaotorios
$numerosAleatorios = array(
                    array("f" => 4, "c" => 5),
                    array("f" => 7, "c" => 8),
);

*/


$procesaFormulario = false;
$numAciertos  = 0;
$iconoRespuesta = "";
$claseRespuesta = "";


if(isset($_POST["send"])){
    $procesaFormulario = true;
    var_dump($_POST["num"]);
    foreach ($_POST["num"] as $f => $v1) {
        foreach ($v1 as $c => $v2) {
            $numerosAleatorios[] = array("f"=> $f,  "c" => $c);
            $valoresActuales[$f][$c] = $v2;
            if ($valoresActuales[$f][$c] == $f * $c) {
                $numAciertos++;
            }
        }
    }
    
}
else{
    for ($i=0; $i < NUMINPUTS; $i++) { 
        do {
            $f = rand(1,NUMTABLAS);
            $c = rand(1,NUMTABLAS);
        } while (existeCoordenada($f,$c,$numerosAleatorios));
        $numerosAleatorios[] = array("f" => $f, "c" => $c);
        $valoresActuales[$f][$c] = "";//vacio en el value
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
    <table>
        <tr>
        <td class="cabecera"> X</td>

        <?php
        //Construcción del formulario

        for ($i=1; $i <= NUMTABLAS; $i++) { 
            echo"<td class=\"cabecera\"> $i </td>";
        }
        echo "</tr>";

        for ($f=1; $f <= NUMTABLAS ; $f++) { 
            echo"<tr>";
            echo "<td class= \"cabecera\"> $f </td>";
            for ($c=1; $c <=NUMTABLAS ; $c++) { 
                if (existeCoordenada($f,$c,$numerosAleatorios)) {
                    if ($procesaFormulario) {
                        $iconoRespuesta = $valoresActuales[$f][$c] == $f*$c ? "&#128512" : "&#128534";
                        $claseRespuesta = $valoresActuales[$f][$c] == $f*$c ? "acierto" : "fallo";
                    }
                    echo "<td><input class = \"$claseRespuesta\" title=\"".$f.'x'.$c."\" type =\"text\" name = \"num[".$f."][".$c."]\" value = \"".$valoresActuales[$f][$c]."\"/> $iconoRespuesta </td>";
                }
                else{
                    echo "<td>".$f*$c."</td>";
                }
            }
            echo "</tr>";
        }


        ?>


       
    </table>
    

    <input type="submit" name="send" value="Send">    
    </form>
    <?php
    if ($procesaFormulario) {
        echo "Aciertos: ". $numAciertos;
        if($numAciertos == NUMINPUTS){
            echo "<br>ENHORABUENA. Test completado </br>";
            echo"<a href = \"".htmlspecialchars($_SERVER["PHP_SELF"])."\">Reiniciar</a>";
        }
    }

    ?>
    
</body>
</html>