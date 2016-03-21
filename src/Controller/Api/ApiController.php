<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\Cache\Cache;
use Cake\Utility\Inflector;
use Cake\View\Helper\PaginatorHelper;


class ApiController extends AppController
{

    public $tableName;
    public $responseObjName;
    public $responseData;
    public $message;
    public $error;
    public $success = true;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');

    }

    public function beforeFilter(Event $event){

        parent::beforeFilter($event);

        $this->tableName = $this->request->params['controller'];
        $this->responseObjName = Inflector::underscore($this->request->params['controller']);
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
            'page'=>$_GET['page'],
            'order'=>$this->{$this->tableName}->order
        );

        //pr($this->request->query);exit;
        if(isset($this->request->query['cOrder'][0]['field'])){

            $this->paginate['order'] = array($this->request->query['cOrder'][0]['field'] => $this->request->query['cOrder'][0]['dir']);
        }
        $this->responseData['children'] = $this->paginate();
        $this->responseData['paging']= array($this->responseObjName=>array(
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
     * @throws NotFoundException
     */
    public function add(){
        try{
            if(isset($this->request->data['action']) && $this->request->data['action'] == "create" && isset($this->request->data['models'])) {
                $kendoData = json_decode($this->request->data['models'],true);
            } else {
                throw new NotFoundException(__('Invalid create request'));
            }
            $tableobj = $this->{$this->tableName}->newEntity();

            if ($this->request->is('post')) {

                $tableobj = $this->{$this->tableName}->patchEntity($tableobj, $kendoData[0]);
                if ($this->{$this->tableName}->save($tableobj)) {

                    $this->message = 'saved record';
                } else {

                    $this->success = false;
                    $this->message = 'could not saved record';
                    $this->validationErrors = $tableobj->errors();
                }
            }
        }catch(Exception $e){

        }


    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null){
        try{
            $data = json_decode($this->request->data['models'],true);
            $recipe = $this->{$this->tableName}->get($id);
            if ($this->request->is(['post', 'put'])) {
                $recipe = $this->{$this->tableName}->patchEntity($recipe, $data[0]);
                if ($this->{$this->tableName}->save($recipe)) {
                    $this->message = $this->tableName. ' details Saved';
                } else {
                    $this->success = false;
                    $this->message = 'Error';
                }
            }
        }catch(Exception $e){

        }

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
        $record = $this->{$this->tableName}->get($id);
        $this->message = 'Deleted';
        if (!$this->{$this->tableName}->delete($record)) {
            $this->success = false;
            $this->message = 'Error';
        }
    }


    public function beforeRender(Event $event){
        parent::beforeRender($event);

            $this->set([
            $this->responseObjName => $this->responseData,
            'validationErrors'=>$this->validationErrors,
            'success'=>$this->success,
            'message' =>$this->message,

            '_serialize' => [$this->responseObjName,'message','success','validationErrors'],
        ]);
    }
}
