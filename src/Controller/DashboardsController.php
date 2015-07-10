<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */

class DashboardsController extends AppController
{

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }


    public function index(){



        $this->layout ='loggedin';
        $name = $this->Auth->user('first_name').' '.$this->Auth->user('last_name');
        $this->set(compact('name'));
    }

}
