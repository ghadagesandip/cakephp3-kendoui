<?php
namespace App\Controller\Admin;

use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\Cache\Cache;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AdminController{

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }

    public function login(){

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
}
