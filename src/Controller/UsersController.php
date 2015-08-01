<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Cache\Cache;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }


    public function login()
    {

        if ($this->request->is('post')) {
            //echo '<pre>'; print_r($this->request->data);exit;
            $user = $this->Auth->identify();
            //echo '<pre>'; print_r($user);exit;
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(
                    __('Username or password is incorrect'),
                    'default',
                    [],
                    'auth'
                );
            }
        }
    }


    /**
     * logout method
     *
     */
    public function logout(){
        if($this->Auth->logout()){
            $this->Flash->success('You are logged out successfully');
            $this->redirect($this->Auth->redirectUrl());
        }

    }

    public $paginate = [
        'finder' => 'active',
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        //echo $this->Math->doAddition(2,4);exit;

        $users = $this->paginate($this->Users);
        $this->set('users', $users);
        $this->set('_serialize', ['users']);
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


        if (($posts = Cache::read('user'.$id)) === false) {
            $user = $this->Users->get($id, [
                'contain' => ['Bookmarks']
            ]);
            Cache::write('user'.$id, $user);
        }
//        $user = $this->Users->get($id, [
//            'contain' => ['Bookmarks']
//        ]);

        $this->set('user', Cache::read('user'.$id));
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
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
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
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
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
