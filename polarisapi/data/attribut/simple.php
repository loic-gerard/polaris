<?php

namespace polarisapi\data\attribut;

use polarisapi\data\attribut\Attribut;
use PolarisCore;

class Simple extends Attribut{
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
        $output .= $this->renderEditFormElement(null, $this->getFinalValue());
        
        return $output;
    }
}
