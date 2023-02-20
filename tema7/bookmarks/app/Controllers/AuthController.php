<?php

namespace App\Controllers;

use App\Models\Usuario;

class AuthController
{
    public static function LoginAction($usuario, $passwd){
        $ObjUsuario = Usuario::getInstancia();
        $ObjUsuario->setUsuario($usuario);
        $ObjUsuario->setPasswd($passwd);
        $data = $ObjUsuario->existe();
        if($data != null){
            foreach ($data[0] as $key => $value) {
                if ($key == "bloqueado") {
                    $ObjUsuario->setBloqueado($value);
                }
                if ($key == "perfil") {
                    $ObjUsuario->setPerfil($value);
                }
                if ($key == "id") {
                    $ObjUsuario->setId($value);
                }
            }
            if ($ObjUsuario->getBloqueado() == 1) {
                $mensaje = "Usuario bloqueado";
            }
            else {
                if ($_SESSION["userErroneo"] == $usuario) { // Si el usuario que era erroneo es correcto reiniciamos contador y userErroneo.
                    $_SESSION["contador"] = 0;
                    $_SESSION["userErroneo"] = "";
                }
                $_SESSION["perfil"] = $ObjUsuario->getPerfil();
                $_SESSION["idUsuario"] = $ObjUsuario->getId();
                $mensaje = "";
                header("Location: /");
            }
        }
        else{
            if ($ObjUsuario->existeUsuario()) {
                // Si existe el usuario pero la contraseña no es correcta
                if ($_SESSION["userErroneo"] != $usuario) {
                    $_SESSION["userErroneo"] = $usuario;
                    $_SESSION["contador"] = 1;
                }
                elseif ($_SESSION["userErroneo"] == $usuario) {
                    $_SESSION["contador"]++;
                }
                $mensaje =  "Usuario o contraseña incorrectos";
                
                if (($_SESSION["userErroneo"] == $usuario) && ($_SESSION["contador"] == 3)) {
                    $ObjUsuario->bloquear($_SESSION["userErroneo"]);
                    $mensaje =  "Usuario bloqueado has superado el numero de intentos.";
                }
            }
            else { //Si no existe el usuario en la base de datos
                $mensaje =  "Usuario o contraseña incorrectos";
            } 

        }
        return $mensaje;
    }

    public static function desbloquearAction($arrayId){
        $objUsuario  = Usuario::getInstancia();
        $objUsuario->desbloquear($arrayId);
    }

    public static function getBloqueadosAction(){
        $objUsuario  = Usuario::getInstancia();
        $usersBlockeds = $objUsuario->getBloqueados();
        return $usersBlockeds;
    }

    public static function LogoutAction(){
        session_destroy();
        unset($_SESSION);
        header("Location: /");
    }

}

?>