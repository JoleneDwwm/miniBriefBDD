<?php
class Template
{
    var $assignedValues = array();
    var $tpl; 

    function __construct($_path = '')
    {
        if(!empty($_path))
        {
            if(file_exists($_path))
            {
                $this->tpl = file_get_contents($_path);
            }
            else
            {
                echo "Template error : file inclusion error";
            }
        }
    }

    function assign($_searchString, $_replaceString)
    {
        if(!empty($_searchString))
        {
            $this->assignedValues[strtoupper($_searchString)] = $_replaceString;
        }
    }

    function show()
    {
        if(count($this->assignedValues) > 0)
        {
            foreach($this->assignedValues as $key => $value)
            {
                $this->tpl = str_replace('{'.$key.'}', $value, $this->tpl);
            }
        }

        echo $this->tpl;
    }
}
?>