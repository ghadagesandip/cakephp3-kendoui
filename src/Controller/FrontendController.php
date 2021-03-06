<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class FrontendController extends AppController{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize(){
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Paginator');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password']
                ],
            ],
            'loginRedirect'=>['controller'=>'users','action'=>'index']
        ]);

        $this->loadComponent('Cookie', ['expiry' => '1 day']);
        $this->loadComponent('Math');
        $this->loadComponent('FileUpload',[
                'uploadDir'=> WWW_ROOT.'img'.DS.'upload'.DS,
                'thumbs'=>[
                    'small'=>[10,10],'medium'=>[20,20],'large'=>[30,30]
                ]
            ]
        );

        $this->Auth->__set('sessionKey', 'Auth.frontuser');
    }



    public function beforeFilter(Event $event){

        if($this->Auth->user('id')){
            $this->viewBuilder()->layout('loggedin');
        }else{
            $this->viewBuilder()->layout('default');
        }
    }

}
