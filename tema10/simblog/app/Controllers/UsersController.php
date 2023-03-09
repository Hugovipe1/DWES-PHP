<?php
/**
 * @author Hugo Vicente Peligro
 */

namespace App\Controllers;
use App\Models\Usuario;
class UsersController extends BaseController{
    public function getAddUser(){
        return $this->renderHTML("addUser.twig");
    }
    public function postAddUser($request){
        $postData = $request->getParsedBody();
        $user = new Usuario();
        $user->nombre = $postData['nombre'];
        $user->user = $postData['user'];
        $user->email = $postData['email'];
        $user->password = password_hash($postData['password'], PASSWORD_DEFAULT);
        $user->perfil = $postData['perfil'];
        $user->save();
        return $this->renderHTML("addUser.twig", [
            "responseMessage" => "Saved"
        ]);
    }
}
?>