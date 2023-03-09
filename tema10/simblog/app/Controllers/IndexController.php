<?php
/**
 * @author Hugo Vicente Peligro
 */
namespace App\Controllers;
use App\Models\Blog;
use App\Models\Comment;
class IndexController extends BaseController{
    public function indexAction(){
        $comments = Comment::orderBy("created_at", "desc")->take(5)->get();
        //nube de tags
        // $tags = Blog::all();
        // $tagCloud = array();
        // foreach ($tags as $tag) {
        //     $tagCloud = array_merge($tagCloud, explode(",", $tag->tags));
        // }
        // $tagCloud = array_count_values($tagCloud);
        // arsort($tagCloud);
        // $tagCloud = array_slice($tagCloud, 0, 20);
        $tags = Blog::all();
        $tags = $tags->pluck('tags'); //obtenemos los tags de todos los blogs
        $tags = $tags->implode(','); //los convertimos en un string
        $tags = explode(',', $tags); //los convertimos en un array
        $tags = array_count_values($tags); //contamos las veces que se repite cada tag //ordenamos el array de mayor a menor
        $tags = array_slice($tags, 0, 10); //obtenemos los 10 primeros elementos del array
        
        $blogs = Blog::all();
        return $this->renderHTML("index.twig", [
            "blogs" => $blogs,
            "latestComments" => $comments,
            "tags" => $tags
        ]);
    }
}
?>