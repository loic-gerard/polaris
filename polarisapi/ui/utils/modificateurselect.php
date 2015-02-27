<?php

namespace polarisapi\ui\utils;

use polarisapi\data\View;

class ModificateurSelect{
    private $view;
    private $addToHtml;
    private $cumul;
    private $formName;
    
    public function __construct($type, $addToHtml = '', $cumul = false, $formName = null) {
        $this->view = new View('MODIFICATEUR', 'pk_entite', 'ASC', 'v_MODIFICATEUR_TYPE.tt_valeur=\''.$type.'\'', array('MODIFICATEUR_TYPE', 'MODIFICATEUR_LABEL', 'MODIFICATEUR_CATEGORIE', 'MODIFICATEUR_DEFAUT', 'MODIFICATEUR_VALUE', 'MODIFICATEUR_CATEGORIE_ID'));
        $this->addToHtml = $addToHtml;
	$this->cumul = $cumul;
	$this->formName = $formName;
    }
    
    public function build(){
        $output = '';
        $output .= '<table>';
        
        $oldCat = '';
        foreach ($this->view AS $l){
            $uid = uniqid();
            
            if($oldCat != $l['MODIFICATEUR_CATEGORIE']){
                $oldCat = $l['MODIFICATEUR_CATEGORIE'];
                $output .= '<tr class="header">';
                $output .= '<td colspan=3 class="centerCell">'.$l['MODIFICATEUR_CATEGORIE'].'</td>';
                $output .= '</tr>';
            }
            if($this->cumul){
                $output .= '<tr class="modifiable" onClick="javascript:if(document.getElementById(\'modif_'.$l['id'].'\').checked){ document.getElementById(\'modif_'.$l['id'].'\').checked = false; }else{ document.getElementById(\'modif_'.$l['id'].'\').checked = true; }">';
            }else{
                $output .= '<tr class="modifiable" onClick="javascript:if(document.getElementById(\'modif_'.$l['MODIFICATEUR_CATEGORIE_ID'].'_'.$uid.'\').checked){ document.getElementById(\'modif_'.$l['MODIFICATEUR_CATEGORIE_ID'].'_'.$uid.'\').checked = false; }else{ document.getElementById(\'modif_'.$l['MODIFICATEUR_CATEGORIE_ID'].'_'.$uid.'\').checked = true; }">';
            }
            $selected = '';
            if($l['MODIFICATEUR_DEFAUT'] == 1){
                $selected = ' checked="checked" ';
            }
            $output .= '<td width=20>';
	    if($this->cumul){
		$output .= '<input id="modif_'.$l['id'].'" '.$this->addToHtml.' type="checkbox" '.$selected.' name="'.$this->formName.'[]" value="'.$l['id'].'">';
	    }else{
		$output .= '<input id="modif_'.$l['MODIFICATEUR_CATEGORIE_ID'].'_'.$uid.'" '.$this->addToHtml.' type="radio" '.$selected.' name="'.$l['MODIFICATEUR_CATEGORIE_ID'].'" id="'.$l['MODIFICATEUR_CATEGORIE_ID'].'" value="'.$l['id'].'">';
	    }
	    
	    $output .= '</td>';
            $output .= '<td class="leftCell">'.$l['MODIFICATEUR_LABEL'].'</td>';
            $v = $l['MODIFICATEUR_VALUE'];
            if($v >= 0){
                $output .= '<td>+'.$v.'</td>';
            }else{
                $output .= '<td>'.$v.'</td>';
            }
            $output .= '</tr>';
        }
        $output .= '</table>';
        
        return $output;
    }
}
