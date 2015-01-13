<?php

namespace polarisapi\data\attribut;

use polarisapi\data\attribut\ComplexeAttribut;
use jin\query\Query;
use PolarisCore;

class Equipement extends ComplexeAttribut{
    
    public function getFinalValue() {
        return $this->getData('protection');
    }
    
    public function renderForDisplay(){

        $modUrl = '';
        if($this->isModifiable()){
            $modUrl = PolarisCore::getModifierUrl($this->entiteId, $this->attributCode, true);
        }
        
        $output = '<tr class="'.$this->getModClass().'" '.$modUrl.'>';
        $output .= '<td>'.$this->getAttributName().'</td>';
        $output .= '<td>'.$this->getValue('initial').'</td>';
        $output .= '<td>'.$this->getModifier().'</td>';
        $output .= '<td>'.$this->getFinalValue().'</td>';
        $output .= '</tr>';
        
        return $output;
    }
    
    public function renderForEdit(){
        $output = '';
        $output .= $this->renderEditFormElement('initial', $this->getValue('initial'));
        
        return $output;
    }
}