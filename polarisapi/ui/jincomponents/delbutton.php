<?php

namespace polarisapi\ui\jincomponents;

use jin\output\components\ComponentInterface;
use jin\output\components\form\FormComponent;
use PolarisCore;

class DelButton extends FormComponent implements ComponentInterface{
    
    public function __construct($name) {
        parent::__construct($name, 'delbutton');
    }
    
    public function render(){
        if(parent::getValue()){
            $html = parent::render();
            return $html;
        }
        return '';
    }

}
