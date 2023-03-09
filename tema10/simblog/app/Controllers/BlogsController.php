<?php

/**
 *@author Hugo Vicente Peligro 
 */

namespace App\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Respect\Validation\Validator as v;

class BlogsController extends BaseController
{
    public function getAddBlogAction($request)
    {
        $responseMessage = null;
        if ($request->getMethod() == "POST") {
            $postData = $request->getParsedBody();
            //Añadimos validación de datos con la librería Respect/Validation
            $blogValidator = v::key("title", v::stringType()->notEmpty())
                ->key("description", v::stringType()->notEmpty());
            try {
                $blog = new Blog();
                $blog->title = $postData["title"];
                $blog->blog = $postData["description"];
                $blog->tags = $postData["tag"];
                $blog->author = $postData["author"];
                //carga de archivos
                $files = $request->getUploadedFiles();
                $image = $files["image"];
                if ($image->getError() == UPLOAD_ERR_OK) {
                    $fileName = $image->getClientFilename();
                    $fileName = uniqid() . $fileName;
                    $image->moveTo("./img/$fileName");
                    $blog->image = $fileName;
                }
                $blog->save();
                $responseMessage = "Saved";
            } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
            }
        }
        return $this->renderHTML("addBlog.twig", [
            "responseMessage" => $responseMessage
        ]);
    }

    public function showBlogAction($request)
    {
        $ruta = $request->getUri()->getPath();
        $id = explode("/", $ruta);
        $blogId = $id[2];
        $blog = Blog::find($blogId);
        $comments = Comment::where("blog_id", $blogId)->get();
        return $this->renderHTML("showBlog.twig", [
            "blog" => $blog,
            "comments" => $comments
        ]);
    }

    public function aboutAction($request)
    {
        return $this->renderHTML("./Page/about.html.twig");
    }

    public function contactAction($request)
    {
        return $this->renderHTML("./Page/contact.html.twig");
    }
}
