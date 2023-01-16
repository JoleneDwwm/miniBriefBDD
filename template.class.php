<?php
class Template
{
    var $assignedValues = array();
    var $partialBuffer; 
    var $tpl; 

    function __construct($_path = ''){
        if(!empty($_path)){
            if(file_exists($_path)){
                $this->tpl = file_get_contents($_path);
            }
            else{
                echo "Template error : file inclusion error";
            }
        }
    }

    function assign($_searchString, $_replaceString){
        if(!empty($_searchString)){
            $this->assignedValues[strtoupper($_searchString)] = $_replaceString;
        }
    }

    function renderPartial($_searchString, $_path, $_assignedValues = array()){
        if(!empy($_searchString)){
            if(file_exists($_path)){
                $this->partialBuffer = file_get_contents($_path);
                if(count($_assignedValues) > 0){
                    foreach($_assignedValues as $key => $value){
                        $this->$partialBuffer = str_replace('{'.strtoupper($key).'}', $value, $this->partialBuffer );
                    }
                }
                $this->tpl = str_replace('['.strtoupper($_searchString).']', $this->partialBuffer, $this->tpl); 
                $this->partialBuffer = '';
            }
            else{
                echo "Template error : partial inclusion error";
            }
        }
    }

    function show(){
        if(count($this->assignedValues) > 0){
            foreach($this->assignedValues as $key => $value){
                $this->tpl = str_replace('{'.$key.'}', $value, $this->tpl);
            }
        }
        echo $this->tpl;
    }
}