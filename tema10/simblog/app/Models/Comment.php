<?php


/**
 * @author Hugo Vicente Peligro
 */

namespace App\Models;
use App\Models\DBAbstractModel;
use \Illuminate\Database\Eloquent\Model;

 class Comment extends Model{
    protected $table = "comment";
    protected $fillable = ['user', 'comment', 'created_at', 'blog_id'];
    // private $user;
    // private $comment;
    // private $blog;
    // private $created;

    // public function getUser() {
    //     return $this->user;
    // }
    // public function setUser($user) {
    //     $this->user = $user;
    // }
    // public function getComment() {
    //     return $this->comment;
    // }
    // public function setComment($comment) {
    //     $this->comment = $comment;
    // }
    // public function getBlog() {
    //     return $this->blog;
    // }
    // public function setBlog($blog) {
    //     $this->blog = $blog;
    // }
    // public function getCreated() {
    //     return $this->created;
    // }
    // public function setCreated($created) {
    //     $this->created = $created;
    // }
    // public function get(){

    // }
    // public function set(){
    //     $this->query = "INSERT INTO comment ( user, comment, created_at, blog_id) VALUES (:user, :comment, :created, :blog)";
    //     $this->parametros['blog'] = $this->blog;
    //     $this->parametros['user'] = $this->user;
    //     $this->parametros['comment'] = $this->comment;
    //     if (!$this->created) {
    //         $this->created = new \DateTime();
    //     }
    //     $mFormat = "Y/m/d H:i";
    //     $this->created = $this->created->format($mFormat);
    //     $this->parametros['created'] = $this->created;
    //     $this->get_results_from_query();
    // }   
    // public function edit(){

    // }
    // public function delete(){

    // }
 }
?>