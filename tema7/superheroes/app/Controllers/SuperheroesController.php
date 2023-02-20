<?php

namespace App\Controllers;

use App\Models\Superheroe;

use App\Controllers\AuthController;

class SuperheroesController extends BaseController
{
    public function IndexAction($request)
    {
        if (!isset($_SESSION["perfil"])) {
            $_SESSION["perfil"] = "invitado";
        }
        $ObjSuperheroe = Superheroe::getInstancia();
        $data = $ObjSuperheroe->getAll();
        if (isset($_POST["enviar"])) {
            $usuario =  AuthController::LoginAction($_POST["usuario"], $_POST["passwd"]);
            if ($usuario != null) {
                $_SESSION["perfil"] = "admin";
            }
        }
        if (isset($_POST["buscar"])) {
            $ObjSuperheroe->setNombre($_POST["nombre"]);
            $data = $ObjSuperheroe->get();
        }
        $this->renderHTML("../views/index_view.php", $data);
    }

    public function AddAction($request)
    {
        if ($_SESSION["perfil"] != "admin") {
            header("Location: /");
        }
        if (isset($_POST["enviar"])) {
            $ObjSuperheroe = Superheroe::getInstancia();
            $ObjSuperheroe->setNombre($_POST["nombre"]);
            $ObjSuperheroe->setVelocidad($_POST["velocidad"]);
            $ObjSuperheroe->set();
            header("Location: /");
        }
        if (isset($_POST["inicio"])) {
            header("Location: /");
        }
        $this->renderHTML("../views/addsuperheroe_view.php");
    }

    public function EditAction($request)
    {
        if ($_SESSION["perfil"] != "admin") {
            header("Location: /");
        } else {
            $numero = explode("/", $request);
            $data = array("numero" => $numero[3]);
            $id = $data["numero"];
            $ObjSuperheroe = Superheroe::getInstancia();
            $ObjSuperheroe->setId($id);
            $data = $ObjSuperheroe->getSuperheroeById();
            if (isset($_POST["enviar"])) {
                // Limpiar datos enviados a la base de datos
                $ObjSuperheroe->setNombre($_POST["nombre"]);
                $ObjSuperheroe->setVelocidad($_POST["velocidad"]);
                $ObjSuperheroe->edit();
                header("Location: /");
            }

            if (isset($_POST["inicio"])) {
                header("Location: /");
            }
        }
        $this->renderHTML("../views/editsuperheroe_view.php", $data);
    }

    public function DelAction($request)
    {
        if ($_SESSION["perfil"] != "admin") {
            header("Location: /");
        } else {
            $numero = explode("/", $request);
            $id = $numero[3];
            $objSuperheroe = Superheroe::getInstancia();
            $objSuperheroe->delete($id);
            header("Location: /");
        }
    }
}
