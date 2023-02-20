<?php
/**
 * Ejercicio gestión de formularios
 * @author Hugo Vicente peligro
 */

 $procesaFormulario = false;
$numero1 = 0;
$numero2 = 0;
 $mensaje1 = "";
$mensaje2 = "";


if (isset($_POST["enviar"])){
    $procesaFormulario = true;
    //Validamos primer input
    $numero1 = $_POST["num1"];
    $numero2 = $_POST["num2"];
    if(empty($numero1)){
        $procesaFormulario = false;
        $mensaje1 = "Número requerido";
    }
    if (empty($numero2)) {
        $procesaFormulario = false;
        $mensaje2 = "Numero requerido";
    }
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
    <?php
    if ($procesaFormulario) {
        echo $numero1 + $numero2;
    }
    else {
        ?>
        <form action="" method="POST">
    <input type="number" name="num1" value="<?php echo $numero1;?>"/> <?php echo $mensaje1   ?>
    <br/>
    <input type="number" name="num2" value ="<?php echo$numero2;?>"/> <?php echo $mensaje2   ?>
    <br/>
    <input type="submit" name="enviar" value ="enviar"/>
    </form>
    <?php
        
    }


    ?>
    
</body>
</html>