<?php
/**
 * @author Hugo Vicente Peligro
 */

 namespace App\Controllers;

use App\Models\Usuario;

class AuthController{

    public static function LoginAction($usuario, $passwd, $perfil){
        $ObjUsuario = Usuario::getInstancia();
        $ObjUsuario->setUsuario($usuario);
        $ObjUsuario->setPasswd($passwd);
        $ObjUsuario->setPerfil($perfil);
        $data = $ObjUsuario->existe();
        if($data != null && $data[0]["estado"] == "Activo"){ // Si existe y es activo resturna el usuario
            return $data;        }
        else{
            return null;
        }
    }

    public static function obtenerPerfil($id){
        $ObjUsuario = Usuario::getInstancia();
        $ObjUsuario->setId($id);
        $data = $ObjUsuario->obtenerPerfil();
        return $data;
    }

    public static function LogoutAction(){
        session_destroy();
        unset($_SESSION["perfil"]);
        header("Location: /");
    }
}
?>