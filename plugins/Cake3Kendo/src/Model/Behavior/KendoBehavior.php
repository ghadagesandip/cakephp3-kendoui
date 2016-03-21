<?php
namespace Cake3Kendo\Model\Behavior;

use Cake\ORM\Behavior;
use App\Model\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;


class KendoBehavior extends Behavior{

    private $dataTypes = array(
        "integer" => "number",
        "decimal" => "number",
        "double" => "number",
        "string" => "string",
        "datetime" => "date",
        "date" => "date",
        "float" => "number",
        "text" => "string",
        "boolean" => "boolean",
        "timestamp" => "date"
    );

    public $tableAlise = null;

    public function initialize(array $config){
        parent::initialize($config); // TODO: Change the autogenerated stub
    }




    public function makeKendoModel(){
        $tableAlias = $this->_table->alias();
        $tableObj = TableRegistry::get($tableAlias);
        $schema = $tableObj->schema();

        $kendoModelArr = array();
        //pr($tableObj->validator()->field('email'));exit;
        $validationRules = $tableObj->validator();
        //change data type based on kendo ui database

        foreach($schema->columns() as $ix=>$field){
            $kendoModelArr[$field] =  $schema->column($field);

            if(isset($this->dataTypes[$schema->column($field)['type']])){
                $kendoModelArr[$field]['type'] = $this->dataTypes[$schema->column($field)['type']];
            }

            if(in_array($field,$tableObj->kendoNonEditable)){
                $kendoModelArr[$field]['editable'] = false;
            }

            /********  validation rules starts here *******/
            if($validationRules->hasField($field)){

                // field is required
                if(($validationRules->field($field)->isPresenceRequired())){
                    $kendoModelArr[$field]['validation']['required'] = array('message'=>$field.' is required.');
                }


                $fieldRules = $validationRules->field($field);
                foreach($fieldRules as $key=>$fileRule){
                    if($fileRule->get('rule')=='email'){
                        $kendoModelArr[$field]['validation']['email'] = array('message'=>$fileRule->get('message'));
                    }
                }

            }

            /********  validation rules ends here *******/
        }

        return array('id'=>$this->_table->primaryKey(),'fields'=>$kendoModelArr);
    }




    public function makeKendoGridCols(){
        $tableAlias = $this->_table->alias();
        $tableObj = TableRegistry::get($tableAlias);
        $schema = $tableObj->schema();

        $cols = array();
        $c = 0;

        foreach($schema->columns() as $idx=>$field){

            if(isset($tableObj->kendoOverrideColumns[$field])){
                $cols[$c] = $tableObj->kendoOverrideColumns[$field];
                continue;
            }

            if(in_array($field,$tableObj->kendoGridHide)){
                $cols[$c]['hidden'] = true;
            }

            if(in_array($field,$tableObj->kendoGridDontShow)){
              continue;
            }

            $cols[$c]['lockable'] = false;
            $cols[$c]['field'] =  $field;
            $cols[$c]['title'] = Inflector::humanize($field);
            $c++;
        }

        //add custom columns to column's list
        if(isset($tableObj->kendoCustomColumns) && is_array($tableObj->kendoCustomColumns)) {
            foreach($tableObj->kendoCustomColumns as $customColumn) {
                $cols[$c] = $customColumn;
                $c++;
            }
        }

        if(isset($tableObj->kendoCommands) && !empty($tableObj->kendoCommands)){
            $cols[$c]['command'] = $tableObj->kendoCommands;
        }



        return $cols;

    }
}

