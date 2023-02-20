<?php
function existeCoordenada($fila, $columna, $array): bool{
    $lExiste = false;
foreach ($array as $key => $value) {
    if (($value['f'] == $fila) and ($value['c'] == $columna)) {
        $lExiste = true;
    }

}
return $lExiste;
}
?>