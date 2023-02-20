<?php
/**
 * Procesamiento del formulario del ejercicio1.php
 * @author Hugo Vicente Peligro
 */
foreach ($_POST as $key => $value) {
    if ($key != "send") {
        echo "<p>$key : $value</p>";
    }
    
}
?>
