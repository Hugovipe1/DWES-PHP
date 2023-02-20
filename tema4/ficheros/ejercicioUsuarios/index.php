<?php
/**
 * @author Hugo Vicente Peligro
 */
include("./config/config.php");
$procesaFormulario = false;
if (isset($_FILES["file"]["name"])) {
    $temp = explode(".", $_FILES["file"]["name"]); //array nombre del fichero
    $extension = end($temp);
    echo "Hola";
    echo $_FILES["file"]["type"];
    echo $_FILES["file"]["name"];
    if (($_FILES["file"]["size"] < MAXSIZE) &&
        in_array($_FILES["file"]["type"], $formatoPermitido) &&
        in_array($extension, $extensiones)
    ) {
        $procesaFormulario = true;

        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"];
        } else {
            $fileName = $_FILES["file"]["name"];
            $fileName = uniqid() . "." . pathinfo($fileName, PATHINFO_EXTENSION);
            echo "Upload: " . $_FILES["file"]["name"] . "<br/>";
            echo "Type: " . $_FILES["file"]["type"] . "<br/>";

            echo "Size: " . ($_FILES["file"]["size"] / 1024) . "kB <br/>";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br/>";
            if (file_exists(DIRUPLOAD.$fileName)) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], DIRUPLOAD . $fileName);
                echo "Stored in: " .DIRUPLOAD.$fileName;
            }
            echo "<br/>";
            //echo "<a href=" . $_SERVER['HTTP_REFERER'] . ">Volver</a><br/>"; // No se recomienda.
            echo '<a href="javascript:history.back()">Volver</a><br/>'; // Mejor.
            
            
            
        }
    } else {
        echo "Invalid file";
    }
}



$imagenes = array();
foreach (scandir(DIRUPLOAD) as $key => $value) {
    if($value != "." && $value != "..")
    $archivos[] = DIRUPLOAD.$value;
    
}


$file = fopen($archivos[0], "r");
$contador = 1;
$letraNombre = "";
$letrasApellido1 = "";
$letrasApellido2 = "";
while(!feof($file)){
    if ($contador >= 8) {
        $cadenaSaneada = strtolower(fgets($file));
        $cadenaSaneada = eliminar_tildes($cadenaSaneada);
        $arrayNombres = explode(" ", $cadenaSaneada);
        var_dump($arrayNombres) ;
    }
    
    $contador++;
}
fclose($file);

function eliminar_tildes($cadena){

    //Codificamos la cadena en formato utf8 en caso de que nos de errores
    $cadena = utf8_encode($cadena);

    //Ahora reemplazamos las letras
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena
    );

    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena );

    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena );

    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena );

    $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena );

    $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $cadena
    );

    return $cadena;
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
<form action="" method="POST" enctype="multipart/form-data">
    Formato: 
    <select name="formato" id="">
    <?php
    foreach ($formato as $key => $value) {
        
            echo("<option value=\"$value\" >$value</option>");
            
        
        
    }
    ?>
    </select><br/>
    Año del curso:
    <select name="year" >
    <?php   
    foreach ($yearToShow as $key => $value) {
        if ($value == $yearDefecto) {
            echo("<option value=\"$value\" selected>$value</option>");
        }
        else {
            echo("<option value=\"$value\" >$value</option>");
            
        }
        
    }
    ?>
    </select>
    <br/><input type="file" name="file">
    <br/><input type="submit" name="enviar">

    
</form>
    
</body>
</html>

