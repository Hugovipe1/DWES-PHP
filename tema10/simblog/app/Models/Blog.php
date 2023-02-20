<?php
/**
 * @author Hugo Vicente Peligro
 */
namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Blog extends Model{
    protected $table = "blog";
    protected $fillable = ['title', 'author', 'blog', 'image', 'tags'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    // private $title;
    // private $blog;
    // private $image;
    // private $author;
    // private $tags;
    // private $created;
    // private $updated;

    // public function getTitle() {
    //     return $this->title;
    // }
    // public function setTitle($title) {
    //     $this->title = $title;
    // }

    // public function getBlog() {
    //     return $this->blog;
    // }
    // public function setBlog($blog) {
    //     $this->blog = $blog;
    // }
    // public function getImage() {
    //     return $this->image;
    // }
    // public function setImage($image) {
    //     $this->image = $image;
    // }
    // public function getAuthor() {
    //     return $this->author;
    // }
    // public function setAuthor($author) {
    //     $this->author = $author;
    // }
    // public function getTags() {
    //     return $this->tags;
    // }
    // public function setTags($tags) {
    //     $this->tags = $tags;
    // }
    // public function getCreated() {
    //     return $this->created;
    // }
    // public function setCreated($created) {
    //     $this->created = $created;
    // }
    // public function getUpdated() {
    //     return $this->updated;
    // }
    // public function setUpdated($updated) {
    //     $this->updated = $updated;
    // }

    // public function get(){
    // }
    // public function set(){
    //     $this->query = "INSERT INTO blog (title, author, blog, image, tags, updated_at) VALUES (:title, :author, :blog, :image,:tags, :updated)";
    //     $this->parametros['title'] = $this->title;
    //     $this->parametros['author'] = $this->author;
    //     $this->parametros['blog'] = $this->blog;
    //     $this->parametros['image'] = $this->image;
    //     $this->parametros['tags'] = $this->tags;
    //     $mFormat = "Y/m/d H:i";
    //     $this->updated = $this->updated->format($mFormat);
    //     $this->parametros['updated'] = $this->updated;
    //     $this->get_results_from_query();
    // }
    // public function edit(){

    // }
    // public function delete(){

    // }
    
}
?>
