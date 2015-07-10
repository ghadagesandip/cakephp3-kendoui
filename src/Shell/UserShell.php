<?php

namespace App\Shell;

use Cake\Console\Shell;

class UserShell extends Shell{

    public function initialize(){
        parent::initialize();
        $this->loadModel('Users');
    }

    public function main(){
        $this->out('Create user use \'user add\' command');
    }

    public function add(){

        $email = $this->in('Enter email address');
        $password = $this->in('Enter password ');

        $user = $this->Users->newEntity();
        $user->email = $email;
        $user->password = $password;
        $user->gender = 1;
        $user->active = 1;

        if($this->Users->save($user)){
            $this->out('<info>User added successfully</info>');
        }else{
            $this->error('<error>Sorry could not add user, try again. </error> ');
        }


    }
}