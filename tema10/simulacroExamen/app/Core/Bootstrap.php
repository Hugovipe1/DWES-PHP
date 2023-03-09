<?php
/**
 * @author Hugo Vicente peligro
 */
namespace App\Core;
use  App\Models\Usuario;
class Bootstrap{
    private static $instancia;
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error("La clonación no es permitida!", E_USER_ERROR);
    }

    static function obtenerTiempoInactividad(){
        $objUsuario = Usuario::getInstancia();
        return $objUsuario->obtenerTiempoInactividad();
    }
}
?>