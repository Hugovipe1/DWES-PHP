<?php
/**
 * @author Hugo Vicente Peligro
 */

namespace App\Controllers;

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
            if ($usuario == "admin" && $password == "admin") {
                return true;
            } else {
                return false;
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