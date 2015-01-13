<?php

namespace polarisapi\data\attribut;

use polarisapi\data\attribut\ComplexeAttribut;
use jin\query\Query;
use PolarisCore;

class Caracsec extends ComplexeAttribut{
    
    public function getFinalValue() {
        return $this->evaluateExpression($this->getData('total'));
    }
    
    public function renderForDisplay(){
        $modUrl = '';
        if($this->isModifiable()){
            $modUrl = PolarisCore::getModifierUrl($this->entiteId, $this->attributCode, true);
        }
        
        $output = '<div '.$modUrl.' class="simpleItem '.$this->getModClass().'">';
        $output .= '<span class="label">'.$this->getAttributName().' :</span> '.$this->getFinalValue();
        $output .= '</div>';
        
        return $output;
    }
    
    public function renderForEdit(){
        $output = '';
        $output .= $this->renderEditFormElement('initial', $this->getValue('initial'));
        
        return $output;
    }
}