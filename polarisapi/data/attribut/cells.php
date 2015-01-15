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
    
    public function renderForSmartDisplay($seuil = null){
    
        $modUrl = '';
	$class = '';
        if($this->isModifiable()){
            $modUrl = PolarisCore::getModifierUrl($this->entiteId, $this->attributCode, true);
	    $class = 'modifiable';
        }
        
        $max = round($this->evaluateExpression($this->getData('max')));
        $v = $this->getValue();
        
        $seuilv = '';
        if(is_numeric($seuil)){
            $seuilv = ' ('.$seuil.')';
        }
        
        $output = '<div  '.$modUrl.' class="cellsItem '.$class.'">';
        if($v>=$max){
            $output .= '<span style="color:red" class="label">'.$this->getAttributName().' : '.$v.'/'.$max.' <font style="color:black">'.$seuilv.'</font></span> ';
        }else if($v > 0){
            $output .= '<span style="color:orange" class="label">'.$this->getAttributName().' : '.$v.'/'.$max.' <font style="color:black">'.$seuilv.'</font></span> ';
        }else if($v == 0){
            $output .= '<span style="color:green" class="label">'.$this->getAttributName().' : '.$v.'/'.$max.' <font style="color:black">'.$seuilv.'</font></span> ';
        }else{
            $output .= '<span class="label">'.$this->getAttributName().' : '.$v.'/'.$max.' <font style="color:black">'.$seuilv.'</font></span> ';
        }
        
        
        $output .= '<div class="clear"></div>';
        
        $output .= '</div>';
        
        return $output;
    }
    
    public function renderForEdit(){
        $output = '';
        $output .= $this->renderEditFormElement(null, $this->getFinalValue());
        
        return $output;
    }
}
