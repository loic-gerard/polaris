<?php

namespace polarisapi\ui\jincomponents;

use jin\output\components\ComponentInterface;
use jin\output\components\form\FormComponent;
use PolarisCore;

class EditButton extends FormComponent implements ComponentInterface{
    
    public function __construct($name) {
        parent::__construct($name, 'editbutton');
    }
    
    public function render(){
        if(parent::getValue()){
            $html = parent::render();
            return $html;
        }
        return '';
    }

}
