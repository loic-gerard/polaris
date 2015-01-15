<?php

namespace polarisapi\data\attribut;

use polarisapi\data\attribut\ComplexeAttribut;
use jin\query\Query;
use PolarisCore;

class Talent extends ComplexeAttribut{
   
    
    public function getFinalValue() {
        return round($this->evaluateExpression($this->getData('total')));
    }
    
    public function getNiveau(){
	return $this->evaluateExpression($this->getData('niveau'));
    }
    
    public function renderForDisplay(){
        $modUrl = '';
        if($this->isModifiable()){
            $modUrl = PolarisCore::getModifierUrl($this->entiteId, $this->attributCode, true);
        }
        
        $plusUrl = 'javascript:updNiveau(\''.$this->getAttributCode().'\', '.$_GET['player'].');';
        
        $output = '<tr class="'.$this->getModClass().'">';
        $output .= '<td>'.$this->getAttributName().' <a href="'.$plusUrl.'">(+10)</a></td>';
        $output .= '<td '.$modUrl.'>'.$this->getNiveau().'</td>';
        $output .= '<td '.$modUrl.'>'.$this->getValue('initial').'%</td>';
        $output .= '<td '.$modUrl.'>'.round($this->evaluateExpression($this->getData('bonus'))).'%</td>';
        $output .= '<td '.$modUrl.'>'.$this->getModifier().'%</td>';
        $output .= '<td '.$modUrl.'>'.$this->getFinalValue().'%</td>';
        $output .= '</tr>';
        
        return $output;
    }
    
    public function renderForEdit(){
        $output = '';
        $output .= $this->renderEditFormElement('initial', $this->getValue('initial'));
        
        return $output;
    }
}