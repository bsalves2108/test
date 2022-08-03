<?php
namespace App\Controller;

/**
 * Calendar Controller
 *
 */
class TodoController extends ApiController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel("TodoList");
    }

    public function index()
    {
        $data = $this->TodoList->find('all')->toList();

        $this->toJson($data);
    }

    public function add()
    {
        $todo = $this->TodoList->newEntity();

        $todo = $this->TodoList->patchEntity($todo, $this->request->getData());

        if ($this->TodoList->save($todo)) {
            $this->toJson($todo->toArray());
        } else {
            $this->errorResponse('houve um erro ao cadastrar sua tarefa');
        }
    }

    public function delete()
    {
        $todo = $this->TodoList->get($this->request->getParam("id"));

        if ($this->TodoList->delete($todo)) {
            $this->toJson($todo->toArray());
        } else {
            $this->errorResponse('houve um erro ao excluir sua tarefa');
        }
    }

    public function edit()
    {
        $todo = $this->TodoList->get($this->request->getData("id"));

        $todo = $this->TodoList->patchEntity($todo, $this->request->getData());

        if ($this->TodoList->save($todo)) {
            $this->toJson($todo->toArray());
        } else {
            $this->errorResponse('houve um erro tentar atualizar sua tarefa');
        }
    }

}
