<?php
include('tests_cnf.php');

$testDisplonibles = array_map(function($v)
{return 'test: '.$v['idTest'].','.$v['Permiso'].','.$v['Categoria'];},$aTests);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
<h1>Test</h1>
        <h2>Seleccione test</h2>
        <form action="mostrar_preguntas.php" method="POST">
            <select name="numero_test">
                <?php 
                for ($i=0; $i<count($testDisplonibles); $i++) {
                    echo "<option value=\"$i\">". $testDisplonibles[$i]."</option>";                    
                }
                ?>
            </select>
        <br>
        <br>
        <input type="submit" value="Enviar" name="submitTest">
    </form>
</body>
</html>