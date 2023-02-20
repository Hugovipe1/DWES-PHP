<?php
/**
 * @author Hugo Vicente Peligro
 * Ejercicio 8 Tablas de multiplicar del 1 al 10. Aplicar estilos en filas/columnas
 */
const N = 10;
const M = 10;
const INPUT = 5;
$numAleatorios = array();

//primero for con do while dentro
//bucle do while(row and column not in array)
for($x = 0; $x<INPUT; $x++){
  do {
    $row = rand(1,10);
    $column = rand(1,10);
    $arrayInterno = array("row" => $row, "column" => $column);

  } while (in_array($row, $numAleatorios)&&in_array($column, $numAleatorios));
  array_push($numAleatorios, $arrayInterno);
}
$procesaFormulario = false;
$esAleatorio = false;
$esInput = false;
$correctos = array();
$incorrectos = array();
$class;
$numAciertos = 0;
$numIncorrectas = 0;

if(isset($_POST["enviar"])){
  $procesaFormulario = true;
  
  foreach ($_POST['num'] as $key => $value) {
    foreach($value as $key1 => $value1){
      if(($key * $key1) == $value1){
        $numAciertos += 1;
        $correctos[$key][$key1] = $value1;
      }
      else{
        $incorrectos[$key][$key1] = $value1;
      }
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
  <link rel="stylesheet" href="./style.css">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
  <?php
  
    echo"<table border =\"2px\">";
    echo"<tr>";
    echo "<td class=\"cabecera\"> X</td>";
    for ($c=1; $c <= N ; $c++) { 
        echo"<th id=\"cabecera\"> $c </th>";
    }
    echo"</tr>";
    
    for ($i=1; $i <= N ; $i++) {
        echo"<tr>";
        echo"<td id=\"cabecera\"> $i </th>";
      for ($n=1; $n <= M ; $n++) {
        
          // Si se le ha dado al botor de enviar
          if ($procesaFormulario) {
            //Recorremos los números incorrectos y hacemos de nuevo input
            foreach ($incorrectos as $key => $value) {
              foreach ($value as $key1 => $value1) {
                if ($key== $i && $key1 == $n) {
                  $esInput = true;
                  $class = "incorrecto";
                  ?>
                  <td id="resultado" class= "<?php echo $class?>"> <input type="text" name="num[<?php echo $i ?>][<?php echo $n?>]" value="<?php echo $value1 ?>"></td>
                  
                  <?php
                }
              }  
            }
            // Recorremos los numeros correctos y hacemos un input disables
            foreach ($correctos as $key => $value) {
              foreach ($value as $key1 => $value1) {
                if ($key== $i && $key1 == $n) {
                  $esInput = true;
                  $class = "correcto";
                  ?>
                  <td id="correcto" class= "<?php echo $class?>"> <input type="text"  name="num[<?php echo $i ?>][<?php echo $n?>]" value="<?php echo $value1 ?>"></td>
                  
                  <?php
                }
              }  
            }
            if(!$esInput){
              echo"<td id=\"resultado\">".$i*$n." </td>";
            }
            $esInput = false;
            
          }
          // Si no se le ha dado al boton de enviar
          else{
            foreach ($numAleatorios as $key => $value) {
              if ($value["row"]== $i && $value["column"] == $n) {
                $esAleatorio = true;
                ?>
                <td id="resultado"><input class= "<?php echo $class?>" type="text" name="num[<?php echo $i ?>][<?php echo $n?>]"></td>
                
                <?php
              }
              
            }
            if(!$esAleatorio){
              echo"<td id=\"resultado\">".$i*$n." </td>";
            }
            $esAleatorio = false;
            
            
          }
        
        
        
        } 
        echo"</tr>"; 
      }
    echo"</table>";
    echo "Has acertado $numAciertos de ".INPUT."<br/>";    
  ?>
  
    <input type="submit" name="enviar">
    </form>
  
</body>
</html>