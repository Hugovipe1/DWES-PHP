<?php 

/**
 * @author Hugo Vicente Peligro
 * 
 */

    //include("./index.php");
    include("./config/test_cnf.php");

    echo "<h2>Respuestas del tipo test: </h2>" . "<br>";
    $string = "";
    
    foreach ($_POST as $key) {
        echo $key  . "<br>";

    }
    
    echo "<h2>Respuestas correctas: </h2>" . "<br>";
    
    $count = 0;
    foreach ($aTests[1] as $clave => $valor) {
        
        if ( $clave == "Corrector") {
            foreach ($valor as $x => $respuestas) {
                foreach ($_POST as $key) {
                    if ($key != "Submit") {
                        $string = $key;
                    }
                }
                
               if ( $string[0] == $respuestas) {
                    ++$count;
               }
            }
            
        }
        
    }

    echo "Las respuestas correctas son: " . $count  . "<br>";

    if ($count >= 8) {
        echo "Has aprobado el test, felicidades.";
    } else {
        echo "Has suspendido el test.";
    }

?>