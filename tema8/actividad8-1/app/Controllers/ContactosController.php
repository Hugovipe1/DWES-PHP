<?php

namespace App\Controllers;

use App\Models\Contactos;


class ContactosController
{
    private $requestMethod;
    private $userId;
    private $response = array();
    public function __construct($requestMethod, $userId)
    {
        $this->requestMethod = $requestMethod;
        $this->userId = $userId;
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->userId) {
                    $this->get($this->userId);
                } else {
                    $this->get();
                }
                break;
            case 'POST':
                $this->post();
                break;
            case 'PUT':
                $this->put($this->userId);
                break;
            case 'DELETE':
                $this->delete($this->userId);
                break;
        }
        header($this->response["status_code_header"]);
        if($this->response["body"]){
            echo $this->response["body"];
        }
        
    }


    public function get($userId = null)
    {
        $contactos = Contactos::getInstancia();
        if ($userId) {
            $result = $contactos->getContactById($userId);
        } else {
            $result = $contactos->get();
        }
        $this->response["status_code_header"] = 'HTTP/1.1 200 OK';
        $this->response["body"] = json_encode($result);
        
    }

    public function post()
    {
        $input = (array) json_decode(file_get_contents('php://input'));
        if (!$input) {
            return;
        } else {

            $contactos = Contactos::getInstancia();
            $result = $contactos->setContactos($input);
            $this->response["status_code_header"] = 'HTTP/1.1 200 OK';
            $this->response["body"] = json_encode($result);
        }
    }

    public function put($id = null)
    {
        $input = (array) json_decode(file_get_contents('php://input'));
        if (!$input || !$id) {
            return;
        } else {
            $contactos = Contactos::getInstancia();
            $result = $contactos->editContactos($input, $id);
            $this->response["status_code_header"] = 'HTTP/1.1 200 OK';
            $this->response["body"] = json_encode($result);
        }
    }

    public function delete($userId)
    {
        $contactos = Contactos::getInstancia();
        $result = $contactos->deleteContactos($userId);
        $this->response["status_code_header"] = 'HTTP/1.1 200 OK';
        $this->response["body"] = json_encode($result);
    }
}
