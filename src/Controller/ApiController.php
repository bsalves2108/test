<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class ApiController extends Controller
{
    public function initialize()
    {
//        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
        $this->setJsonResponse();
    }

    protected function setJsonResponse(){
        $this->loadComponent('RequestHandler');
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->withHeader('content-type', 'application/json');
    }

    public function beforeFilter(Event $event)
    {
        $this->getEventManager()->off($this->Csrf);
    }

    protected function toJson($data)
    {
        $this->set(['result' => $data, '_serialize' => 'result']);
    }

    protected function errorResponse(string $error)
    {
        $this->response->withStatus(403);
        $this->set(['result' => ['message' => $error], '_serialize' => 'result']);
    }
}
