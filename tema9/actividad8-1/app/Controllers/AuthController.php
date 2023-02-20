<?php
/**
 * @author Hugo Vicente Peligro
 */

namespace App\Controllers;

use App\Models\Usuario;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class AuthController{
    public function existeUsuario(){
        $input = (array) json_decode(file_get_contents('php://input'));
        if (!$input) {
            return false;
        } else {
            $usuario = $input["usuario"];
            $password = $input["password"];
            $objUsuario = Usuario::getInstancia();
            if ($objUsuario->existeUsuario($usuario, $password)) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function registrarUsuario(){
        $input = (array) json_decode(file_get_contents('php://input'));
        if (!$input) {
            return false;
        } else {
            $usuario = $input["usuario"];
            $password = $input["password"];
            $objUsuario = Usuario::getInstancia();
            if ($objUsuario->existeUsuarioSinPassword($usuario)) {
                return false;
            } else {
                $objUsuario->setUsuario($usuario, $password);
                return true;
            }
        }
    }

    public function generarToken(){
        $tiempo = time();
        $notBeforeClaim = time();
        $expire = $tiempo + 3600;


        $payload = [
            'iss' => 'http://apirestcontactos.local',
            'aud' => 'http://apirestcontactos.local',
            'iat' => $tiempo,
            'nbf' => $notBeforeClaim,
            "exp" => $expire,
            "data" => array("usuario"=>"admin", "password"=>"admin")
        ];

        $jwt = JWT::encode($payload, KEY, 'HS256');
        return $jwt;
    }



}

?>