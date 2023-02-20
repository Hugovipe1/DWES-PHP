<?php
include('tests_cnf.php');
if (!isset($_POST['submitTest'])) {
    header('Location: index.php');
}

$numeroTest = $_POST['numero_test'];
$testActual = $aTests[$numeroTest]['Preguntas'];

$directorioImagenes = 'dir_img_test'.$aTests[$numeroTest]['idTest'];
$subtitulo = "Test numero : " .$aTests[$numeroTest]['idTest'];
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <h1>Tests</h1>
        <h2><?php echo $subtitulo;?></h2>
        <form method="POST" action="resultado_test.php">
            <?php
            foreach ($testActual as $clavePregunta => $pregunta) {
                echo  $pregunta['Pregunta'] . '<br/>';
                $fileName = $directorioImagenes. '/img'. $pregunta['idPregunta'].'.jpg';
                if (file_exists($fileName)) { 
                    echo "<img src=\"$fileName\"/><br/>";
                 }
                 foreach($pregunta['respuestas'] as $claveRespuesta=>$respuesta) {
                     echo "<input type=\"radio\" name = \"".$clavePregunta. "\" value=\"".$claveRespuesta."\">" . $respuesta . "</br>";
         
                 }
                 echo "<br/>";
               }?>
             <input type="hidden" name="numerotest" value=" <?php echo $numeroTest?> ">
            <input type="submit" name="submitRespuestas">
           </form> 
         </body>
         </html>