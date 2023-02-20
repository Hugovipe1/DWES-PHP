
<?php 

/**
 * @author Hugo Vicente Peligro 
 */

    include("./config/test_cnf.php");
    $testElegido = $_POST["test"]-1;
   
    echo "<h1>Examen tipo test</h1>"  . "<br>";
    echo "Test número: " . $aTests[$testElegido]["idTest"] . "<br>";
    echo "Permiso: " . $aTests[$testElegido]["Permiso"] . "<br>";
    echo "Categoría: " . $aTests[$testElegido]["Categoria"] . "<br>";
    
    foreach ($aTests[$testElegido] as $clave => $valor) {
     
        $i = 1;
        $x = 0;
        if ( $clave == "Preguntas") {
            foreach ($valor as $x => $respuestas) {
                echo $respuestas["Pregunta"] . "<br>";
                echo "<img src=" . "./" ."dir_img_test" . $_POST["test"] . "/" . "img" . $i++ . ".jpg" .">" . "<br>"; 
                echo "<form method=\"post\" action=\"procesaRespuesta.php\">";
                
                $id = $respuestas["idPregunta"];
                foreach ($respuestas["respuestas"] as $key => $value) {
                    echo "<input type=\"radio\" name=\"$id\" value = \"$value\" >$value";
                }
                
                echo "<br>";
            };
            echo "<br>";
            echo '  <input type="submit" name="submit" value="Submit"><br/>';
            echo '<input type="submit" name="testElegido" value="$testElegido" />';
            echo "<button type=\"reset\">Reset</button><br/>";
            echo "</form>";
        }
        
    }
    

?>