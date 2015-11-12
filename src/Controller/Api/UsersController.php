<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\Event\Event;
use Cake\Cache\Cache;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends ApiController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);

    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type']=='dropdownList'){
            echo json_encode(array(array('value'=>1,'text'=>'Male'),array('value'=>0,'text'=>'FeMale')));exit;
        }
        parent::index();
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

       parent::view($id);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      parent::add();
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
        parent::edit($id);
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
       parent::delete($id);
    }
}
