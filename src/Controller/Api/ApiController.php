<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Cache\Cache;
use Cake\View\Helper\PaginatorHelper;



class ApiController extends AppController
{

    public $tableName;
    public $responseObjName;
    public $responseData;
    public $message;
    public $error;

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

    public $paginate = [
        'limit' => 1,
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

        $this->paginate = array(
            'limit'=>$_GET['limit'],
            'page'=>$_GET['page']
        );

        $data = $this->responseData['children'] = $this->paginate();
        $this->responseData['paging']= array('Users'=>array(
            'page'=>$_GET['page'],
            'current'=>1,
            'count'=>$this->{$this->modelClass}->find()->count(),
            'limit'=>$_GET['limit'],
        ));
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

        if(isset($this->request->data['action']) && $this->request->data['action'] == "create" && isset($this->request->data['models'])) {
            $kendoData = json_decode($this->request->data['models'],true);
        } else {
            throw new NotFoundException(__('Invalid create request'));
        }

        $tableobj = $this->{$this->tableName}->newEntity();

        if ($this->request->is('post')) {
            $tableobj = $this->{$this->tableName}->patchEntity($tableobj, $kendoData);
            if ($this->{$this->tableName}->save($tableobj)) {
                $this->message = 'saved record';
            } else {
               pr($this->Users->error);exit;
               $this->message = 'could not saved record';
               $this->error = $this->{$this->tableName}->error;
            }
        }

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
        $data = $this->request->input('json_decode', true); pr($data);exit;
        $recipe = $this->{$this->tableName}->get($id);
        if ($this->request->is(['post', 'put'])) {
            $recipe = $this->{$this->tableName}->patchEntity($recipe, $this->request->data);
            if ($this->{$this->tableName}->save($recipe)) {
                $this->message = 'Saved';
            } else {
                $this->message = 'Error';
            }
        }
        echo $this->message;exit;
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
            'message' =>$this->message,
            '_serialize' => [$this->responseObjName,'message']
        ]);
    }
}
