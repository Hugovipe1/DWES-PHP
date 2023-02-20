<?php
/**
 * @author Hugo Vicente Peligro
 */

$paises = array("España" => array("Madrid", "./img/banderaespaña.jpeg"),
                "Francia" => array("Paris", "./img/banderafrancia.jpeg"),
);
$procesaFormulario = false;
$nombreCapital = "";
$foto = "";

if(isset($_POST["enviar"])){
    $procesaFormulario = true;
    foreach ($paises as $key => $value) {
        if ($_POST["pais"] == $key) {
            $nombreCapital = $value[0];
            $foto = $value[1];
        }
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
    if($procesaFormulario){
        echo "<h1>La capital de ".$_POST["pais"]." es ".$nombreCapital."</h1>";
        echo "<img src='".$foto."' alt='fotoCapital'>";
        echo "<br/>";
        echo"<a href = \"".htmlspecialchars($_SERVER["PHP_SELF"])."\">Reiniciar</a>";
       
    }
    else{
    ?>
    <form action="" method="POST">
        <select name="pais" id="">
            <option value="España">España</option>
            <option value="Francia">Francia</option>
        </select>
        <input type="submit" name="enviar">
        
    </form>
    <?php
    }
    ?>

    
    
</body>
</html>