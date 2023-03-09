<?php
/**
 * @author Hugo Vicente Peligro
 */

namespace App\Controllers;
use App\Controllers\BaseController;
class AdminController extends BaseController{
    public function getAdmin(){
        var_dump($_SESSION['userId']);
        return $this->renderHTML("admin.twig");
    }
}
?>