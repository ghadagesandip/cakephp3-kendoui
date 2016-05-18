<?php
namespace App\Model\Table;

use Cake\ORM\Table;


/**
 * Users Model
 */
class AdminTable extends Table{

    public function initialize(array $config){
        $this->addBehavior('Timestamp');
        $this->addBehavior('Cake3Kendo.Kendo');

        $this->kendoPrefix = "admin";

        //show only this fields
        $this->kendoGridDontShow = array('created','updated','modified','deleted');

        //hide these fields from grid
        $this->kendoGridHide = array('password');

        $this->passwordFields = array('password','confirm_password');

        $this->order = array('id'=> 'desc');
        $this->kendoIgnoreAssoc = array();
        $this->kendoCustomColumns = array();
        $this->kendoCustomSchema = array();
        $this->kendoOverrideColumns = array();
        $this->kendoCommands = array(
            array("name" => "edit"),
            array("name" => "destroy")
        );
        $this->kendoNonEditable = array(
            'id'
        );
    }

}
