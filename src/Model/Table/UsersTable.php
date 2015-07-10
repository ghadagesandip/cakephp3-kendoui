<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {   
        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Bookmarks', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->add('email',[
                    'email'=>[
                        'rule' => 'email',
                        'message'=>'Enter valid email address'
                    ],
                    'unique' => [
                        'rule' => 'validateUnique',
                        'provider' => 'table',
                        'message'=>'User is already registered with this email address'
                    ]
                ]

            )
            ->requirePresence('email', 'create')
            ->notEmpty('email')

            ->requirePresence('password', 'create')
            ->notEmpty('password')

            ->requirePresence('confirm_password', 'create')
            ->notEmpty('confirm_password')

            ->add('confirm_password', 'custom', [
                'rule' =>function ($data, $provider) {

                   if($data != $provider['data']['password']){
                       return 'Password and confirm password fields are not same';
                   }else{
                       return true;
                   }
                }
            ]);
        return $validator;
    }




    public function findActive(Query $query, array $options){
        $query->where([
            'Users.active'=>true
        ]);
        return $query;
    }
}
