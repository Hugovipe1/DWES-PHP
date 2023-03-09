<?php

/**
 * @author Hugo vicente Peligro
 */

namespace App\Controllers;

use App\Models\Recetas;
use App\Models\Usuario;

class RecetasController extends BaseController
{
    public function IndexAction($request)
    {

        $ObjRecetas = Recetas::getInstancia();
        $data = $ObjRecetas->getAll();
        if (isset($_POST["enviar"])) {
            $usuario =  AuthController::LoginAction($_POST["usuario"], $_POST["password"],$_POST["perfil"]);
            var_dump($usuario);
            if ($usuario != null) {
                $perfil = AuthController::obtenerPerfil($usuario[0]["id"]);
                $_SESSION["perfil"] = $perfil[0]["Perfiles_perfil"];
                $_SESSION["id"] = $usuario[0]["id"];
                header("Location: /");
            }
        }
        if (isset($_POST["buscar"])) {
            $ObjRecetas->setTitulo($_POST["nombre"]);
            $data = $ObjRecetas->get();
        }

        if (isset($_POST["votar"])) {
            $objUsuario = Usuario::getInstancia();
            $objUsuario->setId($_SESSION["id"]);
            $objUsuario->insertarVotacion($_POST["idReceta"], $_POST["votacion"]);
        }

        if (isset($_POST["favoritos"])) {
            $objRecetas = Recetas::getInstancia();
            $objRecetas->setId($_POST["idReceta"]);
            $objRecetas->setIdColaborador($_SESSION["id"]);
            $objRecetas->addRecetaFavorita();
        }
        $this->renderHTML("../views/index_view.php", $data);
    }

    public function FrecuentesAction($request)
    {
        $this->renderHTML('recetas/frecuentes.php');
    }

    public function addRecetaAction($request)
    {
        if ($_SESSION["perfil"] != "Collaborator") {
            header("Location: /");
        }
        if (isset($_POST["inicio"])) {
            header("Location: /");
        }
        define("DIRUPLOAD", './img/');
        define("MAXSIZE", 30000000);
        $extensiones = array("gif", "jpg", "jpeg");
        $formatoPermitido = array("image/gif", "image/jpg", "image/jpeg");
        if (isset($_POST["add"])) {
            $ObjRecetas = Recetas::getInstancia();
            $ObjRecetas->setTitulo($_POST["titulo"]);
            $ObjRecetas->setIngredientes($_POST["ingredientes"]);
            $ObjRecetas->setElaboracion($_POST["elaboracion"]);
            $ObjRecetas->setEtiquetas($_POST["etiquetas"]);
            $ObjRecetas->setPublica($_POST["publica"]);
            $ObjRecetas->setIdColaborador($_SESSION["id"]);

            if (isset($_FILES["file"]["name"])) {
                $temp = explode(".", $_FILES["file"]["name"]); //array nombre del fichero
                $extension = end($temp);
                if (($_FILES["file"]["size"] < MAXSIZE) &&
                    in_array($_FILES["file"]["type"], $formatoPermitido) &&
                    in_array($extension, $extensiones)
                ) {
                    if ($_FILES["file"]["error"] < 1) {

                        $fileName = $_FILES["file"]["name"];
                        $fileName = uniqid() . "." . pathinfo($fileName, PATHINFO_EXTENSION);
                        if (file_exists(DIRUPLOAD . $fileName)) {
                            // echo $_FILES["file"]["name"] . " already exists. ";
                        } else {
                            move_uploaded_file($_FILES["file"]["tmp_name"], DIRUPLOAD . $fileName);
                            $ObjRecetas->setImagen($fileName);
                            $ObjRecetas->set();
                            header("Location: /");
                        }
                    }
                }
            }
        }
        $this->renderHTML('../views/addReceta_view.php');
    }

    public function deleteRecetaAction($request)
    {
        if ($_SESSION["perfil"] != "Collaborator") {
            header("Location: /");
        }
        $numero = explode("/", $request);
        $id =  $numero[3];
        $ObjRecetas = Recetas::getInstancia();
        $ObjRecetas->setId($id);
        $data  = $ObjRecetas->getIdColaboradorOfReceta();
        if ($data[0]["idColaborador"] == $_SESSION["id"]) {
            unlink("./img/" . $data[0]["imagen"]);
            $ObjRecetas->delete();
        }
        header("Location: /");
    }

    public function editRecetaAction($request)
    {
        if ($_SESSION["perfil"] != "Collaborator") {
            header("Location: /");
        }
        if (isset($_POST["inicio"])) {
            header("Location: /");
        }
        $numero = explode("/", $request);
        $id =  $numero[3];
        $ObjRecetas = Recetas::getInstancia();
        $ObjRecetas->setId($id);
        $data  = $ObjRecetas->getIdColaboradorOfReceta();
        if ($data[0]["idColaborador"] == $_SESSION["id"]) {
            define("DIRUPLOAD", './img/');
            define("MAXSIZE", 30000000);
            $extensiones = array("gif", "jpg", "jpeg");
            $formatoPermitido = array("image/gif", "image/jpg", "image/jpeg");
            if (isset($_POST["enviar"])) {
                $ObjRecetas->setTitulo($_POST["titulo"]);
                $ObjRecetas->setIngredientes($_POST["ingredientes"]);
                $ObjRecetas->setElaboracion($_POST["elaboracion"]);
                $ObjRecetas->setEtiquetas($_POST["etiquetas"]);
                $ObjRecetas->setPublica($_POST["publica"]);
                if (isset($_FILES["file"]["name"])) {
                    if ($_FILES["file"]["name"] == false) {
                        $ObjRecetas->setImagen($_POST["imagenBD"]);
                        $ObjRecetas->edit();
                        header("Location: /");
                    }
                    else{
                        $temp = explode(".", $_FILES["file"]["name"]); //array nombre del fichero
                        $extension = end($temp);
                        if (($_FILES["file"]["size"] < MAXSIZE) &&
                            in_array($_FILES["file"]["type"], $formatoPermitido) &&
                            in_array($extension, $extensiones)
                        ) {
                            if ($_FILES["file"]["error"] < 1) {
                                $fileName = $_FILES["file"]["name"];
                                $fileName = uniqid() . "." . pathinfo($fileName, PATHINFO_EXTENSION);
                                if (file_exists(DIRUPLOAD . $fileName)) {
                                    // echo $_FILES["file"]["name"] . " already exists. ";
                                } else {
                                    move_uploaded_file($_FILES["file"]["tmp_name"], DIRUPLOAD . $fileName);
                                    $ObjRecetas->setImagen($fileName);
                                    $ObjRecetas->edit();
                                    unlink(DIRUPLOAD . $_POST["imagenBD"]);
                                    header("Location: /");
                                }
                            }
                        }
                    }
                }
            }
        } else {
            header("Location: /");
        }
        $this->renderHTML('../views/editReceta_view.php', array("id" => $id, "titulo" => $data[0]["titulo"], "ingredientes" => $data[0]["ingredientes"], "elaboracion" => $data[0]["elaboracion"], "etiquetas" => $data[0]["etiquetas"], "publica" => $data[0]["publica"], "imagen" => $data[0]["imagen"]));
    }

    public function recetasFavoritasAction($request)
    {
        $objRecetas = Recetas::getInstancia();
        $objRecetas->setIdColaborador($_SESSION["id"]);
        $data = $objRecetas->obtenerRecetasFavoritas();
        $this->renderHTML('../views/recetasFavoritas_view.php', $data);
    }

    public function generarDocumentoPagoAction($request){
        $objRecetas = Recetas::getInstancia();
        $idColaboradores = $objRecetas->obtenerIdColaboradores();
        foreach ($idColaboradores as $idColaborador) {
            $objRecetas->setIdColaborador($idColaborador["idColaborador"]);
            $numPublicaciones = $objRecetas->getNumeroPublicaciones($idColaborador["idColaborador"]);
            $data = $objRecetas->obtenerPuntuacion();
            foreach ($numPublicaciones as $numPublicacion) {
                $numPublicaciones = $numPublicacion["COUNT(*)"];
            }
            foreach ($data as $puntuacion) {
                $data = $puntuacion["SUM(puntuacion)"];
            }
            $file = fopen("./fichero/documentoDePago.txt", "w");
            fwrite($file, "DOCUMENTO DE PAGO:\n Colaborador: $idColaborador[idColaborador]\n Importe: 100€ \n Concepto: Colaboración en nuestra revista digital con un total de  $numPublicaciones publicación y una valoración global de $data\n");
        }
        header("Location: /");
    }


}
