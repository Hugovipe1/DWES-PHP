<?php
/**
 * @author Hugo Vicente Peligro
 */
/*function clear_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
}*/
$name = $email = $genero = $comment = $website = "";


$nameErr = $emailErr = $websiteErr = "";
$aGenero  = array("hombre", "mujer", "otro");

$aTransporte = array("bici", "coche","moto");
$transporteValue = array();
$multipleValue = array();

$vehiculos ="";

$aOpcion = array(
    array("value" => 1, "muestra" => "opcion1"),
    array("value" => 2, "muestra" => "opcion2"),
    array("value" => 3, "muestra" => "opcion3"),
    array("value" => 4, "muestra" => "opcion4"),
);
$aOpcionMarca = array(
    array("value" => 1, "muestra" => "Renault"),
    array("value" => 2, "muestra" => "Mercedes"),
    array("value" => 3, "muestra" => "Citroen"),
    array("value" => 4, "muestra" => "Volvo"),
);
$error = false;
$procesaFormulario = false;
if (isset($_POST["enviar"])) {
    $procesaFormulario = true;
    if(!empty($_POST["nombre"])){
        $name = $_POST["nombre"];
    }
    else{
        $error = true;
        $nameErr = "Debes de introducir el nombre para que sea válido";
    }
    if(!empty($_POST["email"])){
        $email = $_POST["email"];
    }
    else {  
        $error = true;
        $emailErr = "Debes de introducir el email para que sea válido";
    }
    if(!empty($_POST["website"])){
        $website = $_POST["website"];
    }
    else{
        $error = true;
        $websiteErr = "Debes de introducir la URL para que sea válido";
    }
    if(!empty($_POST["comment"])){
        $comment = $_POST["comment"];
    }
    if(!empty($_POST["genero"])){
        $genero = $_POST["genero"];
    }
    if(!empty($_POST["transporte"])){
        foreach ($_POST["transporte"] as $key => $value) {
            array_push($transporteValue, $value);
        } 
    }
    if (!empty($_POST["vehiculos"])) {
        foreach ($aOpcion as $key => $value) {
            if ($value["value"] == $_POST["vehiculos"]) {
                $vehiculos = $value["muestra"];
            }
        }
        
    }
    
    if(!empty($_POST["multiple"])){
        foreach ($_POST["multiple"] as $key => $value) {
            foreach ($aOpcionMarca as $key1 => $value1) {
                if ($value1["value"] == $value) {
                    array_push($multipleValue,$value1["muestra"]);
                }
            }
        } 
    }
        
}
if($error){
    $procesaFormulario = false;
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
    if(!$procesaFormulario){
        ?>
    <form action="" method="POST">
        Nombre
        <input type="text" name="nombre" value="<?php echo $name;?>">* <?php echo $nameErr;?>
        <br>
        Email
        <input type="email" name="email" value="<?php echo $email;?>">* <?php echo $emailErr;?>
        <br>
        Url
        <input type="url" name="website" value="<?php echo $website;?>">* <?php echo $websiteErr;?>
        <br>
        Comentario
        <br>
        <textarea name="comment" id="" cols="30" rows="10"><?php echo $comment;?> </textarea>
        <br>
        
        <?php
        echo "Género <br/>";
        foreach ($aGenero as $key => $value) {
            if($value == "hombre"){
                echo "hombre";
            }
            elseif($value == "mujer"){
                echo "mujer";
            }
            else {
                echo "otro";
            }
            echo "<input type=\"radio\" name=\"genero\" value=\"$value\">";
        }
        echo "<br/>Transporte<br/>";
        foreach ($aTransporte as $key => $value) {
            if($value == "bici"){
                echo "bici";
            }
            elseif($value == "coche"){
                echo "coche";
            }
            else {
                echo "moto";
            }
            echo "<input type=\"checkbox\" name=\"transporte[]\" value=\"$value\">";
            
        }
        echo "<br/>Salida de vehículos";
        echo "<select name=\"vehiculos\">";
            foreach ($aOpcion as $key => $value) {
                echo "<option value = \"$value[value]\"> $value[muestra]</option>";
                
            }
        echo "</select>";
        echo "<br/>";
        echo "<br/>Salida de vehículos(múltiplo): ";
        echo "<select name=\"multiple[]\" multiple>";
            foreach ($aOpcionMarca as $key => $value) {
                echo "<option value = \"$value[value]\"> $value[muestra]</option>";
                
            }
        echo "</select>";
        
        echo"<br/> <input type=\"submit\" name=\"enviar\">";
        echo"</form>";
          
    }
    else {
        echo "$name <br/>";
        echo "$email <br/>";
        echo "$website <br/>";
        echo "$comment <br/>";
        echo "$genero <br/>";
        if(count($transporteValue) > 0){
            foreach ($transporteValue as $key => $value) { 
                echo "$value <br/>";
            }
        }
        echo "$vehiculos <br/>";
        if(count($multipleValue) > 0){
            foreach ($multipleValue as $key => $value) { 
                echo "$value <br/>";
            }
        }
        
    }
    ?>
    </form>
</body>
</html>