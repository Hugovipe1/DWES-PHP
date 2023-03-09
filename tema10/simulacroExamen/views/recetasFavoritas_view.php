<?php
/**
 * @author Hugo Vicente Peligro
 */
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
    <h1>Cocina Saludable</h1>
    
    <?php
    echo "<a href=\"/\">Inicio</a>";
        foreach ($data as $key => $value) {
        echo "<h3>$value[titulo]</h3>";
        echo   "<p>$value[ingredientes]</p>";
        echo  "<p>$value[elaboracion]</p>";
        echo  "<p>$value[etiquetas]</p>";
        echo  "<p><img src=\"../img/$value[imagen]\" alt=\"imagen\"></p>";
        }
    ?>
    
</body>
</html>