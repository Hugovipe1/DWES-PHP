<?php
/**
 * @author Hugo Vicente Peligro
 */

namespace App\Controllers;
use App\Models\Comment;
use App\Models\Usuario;
use Laminas\Diactoros\Response\RedirectResponse;

class CommentController extends BaseController{
    public function postCommentAction($request){
        $postData = $request->getParsedBody();
        $comment = new Comment();
        $comment->comment = $postData["comment"];
        $comment->blog_id = $postData["blog_id"];
        if (!isset($_SESSION["userId"])) {
            $comment->user = "Anonymous";
        }
        else{
            // usuario cuando el userid sea igual al id del usuario
            $user = Usuario::find($_SESSION["userId"]);
            $comment->user = $user->nombre;
        }
        $comment->save();
        return new RedirectResponse("/blog/$postData[blog_id]");  
    }
}
?>