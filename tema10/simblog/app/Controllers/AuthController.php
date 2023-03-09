<?php
/**
 * @author Hugo Vicente Peligro
 */

namespace App\Controllers;
use App\Models\Usuario;
use Illuminate\Support\Facades\Redirect;
use Laminas\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController{
    public function getLogin(){
        return $this->renderHTML("login.twig");
    }

    public function postLogin($request){
        $postData = $request->getParsedBody();
        $responseMessage = null;
        
        $user = Usuario::where('email', $postData['email'])->first();
        if($user){
            if(password_verify($postData['password'], $user->password)){
                $_SESSION['userId'] = $user->id;
                echo "Logged in";
                return new RedirectResponse('/admin');                
            }else{
                $responseMessage = "Bad credentials";
            }
        }else{
            $responseMessage = "Bad credentials";
        }
        return $this->renderHTML("login.twig", [
            "responseMessage" => $responseMessage
        ]);
    }

    public function getLogout(){
        unset($_SESSION['userId']);
        return new RedirectResponse('/login');
    }
}
?>