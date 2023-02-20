<?php

namespace App\Controllers;

use App\Models\BookMarks;
use App\Controllers\AuthController;
use Dotenv\Parser\Value;

class BookMarksController extends BaseController
{
    public function IndexAction($request)
    {
        $mensaje = "";
        $dataBookMarks = array();
        $usersBlockeds = array();
        $valueSubmit = "Marcar Todos";

        if (isset($_POST["inicioSesion"])) {
            $data = AuthController::LoginAction($_POST["user"], $_POST["password"]);
        }

        if (isset($_POST["desbloquear"])) {
            AuthController::desbloquearAction($_POST["id"]);
        }

        if ($_SESSION["perfil"] == "user") {
            $objBookMarks = BookMarks::getInstancia();
            $objBookMarks->setIdUsuario($_SESSION["idUsuario"]);
            $dataBookMarks = $objBookMarks->obtenerEnlace();
        } elseif ($_SESSION["perfil"] == "admin") {
            $usersBlockeds = AuthController::getBloqueadosAction();
        }
        if (isset($_POST["marcarDesmarcarTodos"])) {
            $_POST["marcarDesmarcarTodos"] == "Marcar Todos" ? $valueSubmit = "Desmarcar Todos" : $valueSubmit = "Marcar Todos";
        }
        $this->renderHTML("../views/index_view.php", array(
            "mensaje" => $mensaje, "dataBookMarks" => $dataBookMarks,
            "usersBlockeds" => $usersBlockeds, "valueSubmit" => $valueSubmit
        ));
    }

    public function FrecuentesAction($request)
    {
        $objBookMarks = BookMarks::getInstancia();
        $objBookMarks->setIdUsuario($_SESSION["idUsuario"]);
        $bmUrlFrecuentes = $objBookMarks->getBmUrlFrecuentes();
        $valueSubmit = "Marcar Todos";

        if (isset($_POST["marcarDesmarcarTodos"])) {
            $_POST["marcarDesmarcarTodos"] == "Marcar Todos" ? $valueSubmit = "Desmarcar Todos" : $valueSubmit = "Marcar Todos";
        }

        if (isset($_POST["añadirFavoritos"])) {
            if (isset($_POST["id"])) {
                $objBookMarks = BookMarks::getInstancia();
                $objBookMarks->setIdUsuario($_SESSION["idUsuario"]);
                foreach ($_POST["id"] as $value) {
                    $objBookMarks->setbm_url($value);
                    $objBookMarks->setDescripcion("Frecuente en otros usuarios");
                    $objBookMarks->setFrecuentes();
                }
            }
        }

        $this->renderHTML("../views/frecuentes_view.php", array("bmUrlFrecuentes" => $bmUrlFrecuentes, "valueSubmit" => $valueSubmit));
    }

    public function AddAction($request)
    {
        $procesaFormulario = false;
        if (isset($_POST["add"])) {
            $procesaFormulario = true;
        }
        if (isset($_POST["enviar"])) {
            $objBookmarks = BookMarks::getInstancia();
            $objBookmarks->setbm_url($_POST["nombre"]);
            $objBookmarks->setDescripcion($_POST["descripcion"]);
            $objBookmarks->setIdUsuario($_SESSION["idUsuario"]);
            $objBookmarks->set();
            header("Location: /");
        }
        if (isset($_POST["inicio"])) {
            header("Location: /");
        }
        $this->renderHTML("../views/add_view.php", array("procesaFormulario" => $procesaFormulario));
    }

    public function DeleteAction($request)
    {
        $numero = explode("/", $request);
        $id = $numero[3];
        $objBookMarks = BookMarks::getInstancia();
        $objBookMarks->setId($id);
        $data = $objBookMarks->getIdUsuarioOfBookmark();
        foreach ($data as $key => $value) {
            if ($value["idUsuario"] == $_SESSION["idUsuario"]) { //Si el id de la url coincide con el id de la url que queremos borrar
                $autorizado = true;
            }
        }
        if ($autorizado) {
            $objBookMarks->delete($id);
            header("Location: /");
        } else {
            header("Location: /");
        }
    }

    public function EditAction($request)
    {
        $numero = explode("/", $request);
        $id = $numero[3];
        $objBookMarks = BookMarks::getInstancia();
        $objBookMarks->setId($id);
        $data = $objBookMarks->getIdUsuarioOfBookmark();
        foreach ($data as $key => $value) {
            if ($value["idUsuario"] == $_SESSION["idUsuario"]) { //Si el id de la url coincide con el id de la url que queremos borrar
                $bm_url = $value["bm_url"];
                $descripcion = $value["descripcion"];
            } else {
                header("Location: /");
            }
        }
        if (isset($_POST["enviar"])) {
            $objBookMarks->setbm_url($_POST["bm_url"]);
            $objBookMarks->setDescripcion($_POST["descripcion"]);
            var_dump($_POST);
            $objBookMarks->edit();
            header("Location: /");
        }

        $this->renderHTML("../views/edit_view.php", array("bm_url" => $bm_url, "descripcion" => $descripcion));
    }
}
