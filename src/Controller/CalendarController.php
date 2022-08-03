<?php
namespace App\Controller;

/**
 * Calendar Controller
 *
 */
class CalendarController extends ApiController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel("Event");
    }

    public function index()
    {
        $data = $this->Event->find()->where([
            'start_at >=' => $this->request->getQuery('start'),
            'end_at <=' => $this->request->getQuery('end')
        ])->toList();

        $this->toJson($data);
    }

    public function add()
    {
        $event = $this->Event->newEntity();

        $event = $this->Event->patchEntity($event, $this->request->getData());

        if ($this->Event->save($event)) {
            $this->toJson($event->toArray());
        } else {
            $this->errorResponse('houve um erro ao cadastrar seu evento');
        }
    }

    public function delete()
    {
        $event = $this->Event->get($this->request->getParam("id"));

        if ($this->Event->delete($event)) {
            $this->toJson($event->toArray());
        } else {
            $this->errorResponse('houve um erro ao excluir seu evento');
        }
    }

    public function edit()
    {
        $event = $this->Event->get($this->request->getData("id"));

        $event = $this->Event->patchEntity($event, $this->request->getData());

        if ($this->Event->save($event)) {
            $this->toJson($event->toArray());
        } else {
            $this->errorResponse('houve um erro tentar atualizar seu evento');
        }
    }

}
