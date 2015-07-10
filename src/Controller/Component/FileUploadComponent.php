<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class FileuploadComponent extends Component{

    protected $_defaultConfig = [
        'uploadDir' => WWW_ROOT,
        'createThumb'=>false,
        'thumbs'=>[
            //'small'=>[10,10],'medium'=>[20,20],'large'=>[30,30]
        ]
    ];


    public function initialize(array $config){
        $this->_defaultConfig = array_merge($this->_defaultConfig,$config);
        //echo '<pre>'; print_r($this->_defaultConfig); exit;
    }

    public function uploadFile($fileData){

    }

}