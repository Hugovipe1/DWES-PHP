<?php
    /**
     * Crear un script para sumar una serie de números. El número de números a sumar será introducido en 
     * un formulario.
     * 
     * @author Hugo Vicente Peligro
     */
    include "include/functions.php";
    $procesaFormulario = false;
    $numerosInput = 0;
    $sumaDeNumeros = 0;
    $procesaResultado = false;


    if (isset($_POST["enviar"])) {
        if ($_POST["numerosInput"] > 0) {
            $procesaFormulario = true;
            $numerosInput = $_POST["numerosInput"];
        }
        
    }
    if (isset($_POST["botonSuma"])) {
        $procesaResultado = true;
        $sumaDeNumeros = sumaNumeros($_POST["numeros"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="number" name="numerosInput">
        <input type="submit" name="enviar">
    </form>
        <?php

    if ($procesaFormulario) {
    

        ?>
        <form action="" method="POST">
        <?php
        for ($i = 0; $i < $numerosInput; $i++){
            echo "<br/>";
            echo "<input type=\"number\" name=\"numeros[$i]\">";
        }
        echo "<br/> <input type=\"submit\" name=\"botonSuma\">";
        
    }

        ?>
        </form>
        <?php
        if ($procesaResultado) {
            echo"<p>La suma de los números introducidos es $sumaDeNumeros</p>"; 
            $procesaResultado = false;
        }
        ?>
    

    
    
</body>
</html>