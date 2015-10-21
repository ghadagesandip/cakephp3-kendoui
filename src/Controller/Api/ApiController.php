<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Cache\Cache;


class ApiController extends AppController
{

    public $tableName;
    public $responseObjName;
    public $responseData;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(Event $event){

        parent::beforeFilter($event);
        $this->Auth->allow(['index','add','edit','delete']);
        $this->responseObjName = $this->tableName = $this->request->params['controller'];
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->responseData = $this->{$this->tableName}->find('all');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {

        $recipe = $this->Users->get($id);
        $this->set([
            'recipe' => $recipe,
            '_serialize' => ['recipe']
        ]);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $recipe = $this->Users->newEntity($this->request->data);
        if ($this->Users->save($recipe)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'recipe' => $recipe,
            '_serialize' => ['message', 'recipe']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $recipe = $this->Users->get($id);
        if ($this->request->is(['post', 'put'])) {
            $recipe = $this->Users->patchEntity($recipe, $this->request->data);
            if ($this->Users->save($recipe)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $recipe = $this->Users->get($id);
        $message = 'Deleted';
        if (!$this->Users->delete($recipe)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }


    public function beforeRender(Event $event){
        parent::beforeRender($event);
            $this->set([
            $this->responseObjName => $this->responseData,
            '_serialize' => [$this->responseObjName]
        ]);
    }
}
