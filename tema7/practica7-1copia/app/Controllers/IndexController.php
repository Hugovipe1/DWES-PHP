<?php
namespace App\Controllers;

class IndexController extends BaseController{
    public function IndexAction()
    {
        $data = array("message" => "Hola Mundo");
        $this->renderHTML("../views/index_view1.php", $data);
    }

    public function SaludaAction($request){
        $nombre = explode("/", $request);
        $data = array("message" => "Hola $nombre[2]");
        $this->renderHTML("../views/index_view1.php", $data);
    }
}

?>