<?php
namespace App\Controllers;

class NumerosController extends BaseController{
    public function NumerosAction()
    {
        
        $data = array("message" => $this->generarPares());
        $this->renderHTML("../views/index_view.php", $data);
    }

    public function NumerosContadosAction($request)
    {
        $numero = explode("/", $request);
        $data = array("message" => $this->generarParesContados($numero[2]));
        $this->renderHTML("../views/index_view.php", $data);
    }

    private function generarPares(){
        for ($i=1; $i <= 10; $i++) { 
            $array[$i] =  $i + $i;
        }
        return $array;
    }

    private function generarParesContados($numero){
        for ($i=1; $i <= $numero; $i++) { 
            $array[$i] =  $i + $i;
        }
        return $array;
    }
}

?>