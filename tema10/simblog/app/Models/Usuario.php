<?php
/**
 * @author Hugo Vicente Peligro
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends  Model{
    protected $table = "users";
    protected $fillable = ['email', 'password', 'nombre','user','perfil'];
}

    
?>