<?php
/**
 * @author Hugo Vicente Peligro
 */

 namespace App\Controllers;
 use App\Models\Usuario;
  class AuthController{
    public static function LoginAction($usuario, $password){
        $ObjUsuario = Usuario::getInstancia();
        $ObjUsuario->setUsuario($usuario);
        $ObjUsuario->setPassword($password);
        $data = $ObjUsuario->existe();
        if($data != null){
            return $data;        }
        else{
            return null;
        }
    }

    public static function LogoutAction(){
        session_destroy();
        unset($_SESSION["perfil"]);
        header("Location: /");
    }

}

?>