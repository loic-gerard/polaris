<?php

namespace polarisapi\data\attribut;

use polarisapi\data\attribut\Attribut;
use PolarisCore;

class Cells extends Attribut{
    public function renderForDisplay(){
        $modUrl = '';
	$class = '';
        if($this->isModifiable()){
            $modUrl = PolarisCore::getModifierUrl($this->entiteId, $this->attributCode, true);
	    $class = 'modifiable';
        }
        
        $output = '<div  '.$modUrl.' class="cellsItem '.$class.'">';
        $output .= '<span class="label">'.$this->getAttributName().' :</span> ';
        $output .= '<div class="clear"></div>';
        $max = round($this->evaluateExpression($this->getData('max')));
        
        for($i = 0; $i < $max; $i++){
            $cellClass = '';
            if($this->getValue() >= ($i + 1)){
                $cellClass = 'selected';
            }
            $output .= '<div class="cell '.$cellClass.'"></div>';
        }
        
        $output .= '</div>';
        
        return $output;
    }
    
    public function renderForEdit(){
        $output = '';
        $output .= $this->renderEditFormElement(null, $this->getFinalValue());
        
        return $output;
    }
}
