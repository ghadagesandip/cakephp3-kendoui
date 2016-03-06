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
        $this->kendoGridDontShow = array();

        //hide this fields
        $this->kendoGridHide = array();

        $this->kendoIgnoreAssoc = array();
        $this->kendoCustomColumns = array();
        $this->kendoCustomSchema = array();
    }

}
