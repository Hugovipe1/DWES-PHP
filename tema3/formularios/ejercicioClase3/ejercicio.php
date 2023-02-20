<?php
/**
 * 
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
    <form action="proceso_informacion.php" method="post">
    <label><input type="checkbox" name = "check[]" id="cbox1" value="first_checkbox"> Este es mi primer checkbox</label><br>

    <input type="checkbox"  name ="check[]"id="cbox2" value="second_checkbox"> <label for="cbox2">Este es mi segundo checkbox</label>
    <input type="submit"  name="send" value="enviar">    
</form>
</body>
</html>