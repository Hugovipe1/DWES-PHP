<?php
/**
 * @author Hugo Vicente Peligro
 */

namespace App\Controllers;

use App\Models\Multas;
use App\Models\Usuario;

class MultasController extends BaseController
{
    public function IndexAction($request){
        $arrayVideo = ["https://www.youtube.com/embed/jB-xDvBQuL0", "https://www.youtube.com/embed/GRR8QT2Bpz4", "https://www.youtube.com/embed/rnb0fkpeOao"];
        $video = $arrayVideo[array_rand($arrayVideo)];
        if(isset($_POST["enviar"])){
            if ($_POST["figura"] == $_POST["claseComprobar"]) {
                $usuario = AuthController::LoginAction($_POST["usuario"], $_POST["password"]);
                if ($usuario != null) {
                    $_SESSION["perfil"] = $usuario[0]["perfil"];
                    $_SESSION["id"] = $usuario[0]["id"];
                    header("Location: /");
                }
            }
            else{
                header("Location: /");
            }
        }
        $this->renderHTML("../views/index_view.php", array("video" => $video));
        
    }

    public function ListadoMultasAction($request){
        $objMultas = Multas::getInstancia();
        $objMultas->setIdConductor($_SESSION["id"]);
        $multas = $objMultas->getMultasConductor();
        $this->renderHTML("../views/listadoMultas_view.php", array("multas" => $multas));
    }

    public function ListadoMultasAgenteAction($request){
        $usuario = Usuario::getInstancia();
        $usuario->setId($_SESSION["id"]);
        $agente = $usuario->getAgente();
        $objMultas = Multas::getInstancia();
        $objMultas->setIdAgente($_SESSION["id"]);
        $multas = $objMultas->getMultasAgente();
        $this->renderHTML("../views/listadoMultasAgente_view.php", array("multas" => $multas, "agente" => $agente));
    }


    public function addMultaAction($request){

        $usuario = Usuario::getInstancia();
        $usuario->setId($_SESSION["id"]);
        $agente = $usuario->getAgente();
        $conductores = $usuario->getConductores();

        if (isset($_POST["add"])) {
            $objMultas = Multas::getInstancia();
            $objMultas->setMatricula($_POST["matricula"]);
            $objMultas->setFecha($_POST["fecha"]);
            $objMultas->setIdAgente(intval($_SESSION["id"]));
            $nombreUsuario = $usuario->getIdUsuario($_POST["nombre"]);
            $objMultas->setIdConductor($nombreUsuario[0]["id"]);
            if ($_POST["sancion"] == "mgrave") {
                $idImporteSancion  = $objMultas->getIdSancion("Muy grave");
            }
            else{
                $idImporteSancion  = $objMultas->getIdSancion($_POST["sancion"]);
            }
            $objMultas->setIdTipoSanciones($idImporteSancion[0]["id"]);
            $objMultas->setImporte($idImporteSancion[0]["importe"]);
            $objMultas->setDescripcion($_POST["descripcion"]);
            $objMultas->setEstado("Pendiente");
            $objMultas->set();

            $puntosSancion = $idImporteSancion[0]["puntos"];
            $usuario->setId($nombreUsuario[0]["id"]);
            $usuario->setPuntos(intval($puntosSancion));
            $usuario->addPuntos();
            header("Location: /");  
        }

        if (isset($_POST["inicio"])) {
            header("Location: /");
        }

        $this->renderHTML("../views/addMulta_view.php", array(
            "agente" => $agente,
            "conductores" => $conductores));
    }

    public function pagarMultaAction($request){
        $numero = explode("/", $request);
        $id =  $numero[3];

        
        $objMultas = Multas::getInstancia();
        $objMultas->setId($id);
        $isPayMulta = $objMultas->get();
        if ($isPayMulta[0]["estado"] == "Pagada") { //Si la multa esta pagada
            header("Location: /");
        }
        else{
            $objMultas->setId($id);
            $data = $objMultas->getIdConductorMulta();
            if ($_SESSION["id"] == $data[0]["id_conductor"]) {
                $objUsuario = Usuario::getInstancia();
                $objUsuario->setId($data[0]["id_conductor"]);
                $conductor = $objUsuario->get();
                $multa = $objMultas->get();
                //obtener tipo de infraccion
                $objMultas->setIdTipoSanciones($multa[0]["id_tipo_sanciones"]);
                $tipoSancion = $objMultas->obtenerTipoSancion();
                //obtener fecha de la multa
                $fechaMulta = $multa[0]["fecha"];
                //obtener fecha actual
                $fechaActual = date("Y-m-d");
                //obtener diferencia de dias
                $dias = (strtotime($fechaActual)-strtotime($fechaMulta))/86400;
                $dias = abs($dias);
                if ($dias <= 30) {
                    //obtener importe de la multa
                    $importe = $multa[0]["importe"];
                    $importeTotal = $importe* 0.5;
                    $descuento = 50;
                }
                else{
                    $importeTotal = $multa[0]["importe"];
                    $descuento = 0;
                }
            }
            else{
                header("Location: /");
            }
        }

        if (isset($_POST["pagar"])) {
            $objMultas->setDescuento($descuento);
            $objMultas->setEstado("Pagada");
            $objMultas->pagarMultas();
            header("Location: /");
        }
        
        $this->renderHTML("../views/payMulta_view.php", array($multa, $conductor, $tipoSancion, $importeTotal, $descuento));
    }

    public function ListadoConductoresAction($request){
        $usuario = Usuario::getInstancia();
        $conductores = $usuario->getConductores();
        //obtener numero de multas por conductor
        foreach ($conductores as $key => $value) {
            $numMultas = $usuario->obtenerNumSanciones($value["id"]);
            // $conductores[$key]["numMultas"] = $numMultas[0]["numMultas"];
        }   
        if (isset($_POST["buscar"])) {
            $usuario->setNombre($_POST["nombre"]);
            $conductores = $usuario->getConductorByName();
        }
        $this->renderHTML("../views/listadoConductores_view.php", array("conductores" => $conductores));
    }
}
?>