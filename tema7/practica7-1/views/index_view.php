<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola Mundo</title>
</head>
<body>
    <h1>MVC</h1>
    <?php

    //CREAMOS UN INDEX_VIEW PARA CADA CONTROLADOR.
    foreach ($data["message"] as $key => $value) {
        echo "$value <br/>" ;
    }
    ?>
</body>
</html>