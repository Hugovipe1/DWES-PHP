<?php
/**
 * @author Hugo Vicente Peligro
 */

 namespace App\Controllers;

use App\Models\Usuario;

class AuthController{

    public static function LoginAction($usuario, $passwd){
        $ObjUsuario = Usuario::getInstancia();
        $ObjUsuario->setUsuario($usuario);
        $ObjUsuario->setPasswd($passwd);
        $data = $ObjUsuario->existe();
        if($data != null){
           return $data;
        }
        else{
            return null;
        }
    }

    public static function LogoutAction(){
        session_destroy();
        header("Location: /");
    }
}
?>