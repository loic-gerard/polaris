<?php

namespace polarisapi\ui\utils;

use polarisapi\data\View;

class ModificateurSelect{
    private $view;
    private $addToHtml;
    
    public function __construct($type, $addToHtml = '') {
        $this->view = new View('MODIFICATEUR', 'pk_entite', 'ASC', 'v_MODIFICATEUR_TYPE.tt_valeur=\''.$type.'\'', array('MODIFICATEUR_TYPE', 'MODIFICATEUR_LABEL', 'MODIFICATEUR_CATEGORIE', 'MODIFICATEUR_DEFAUT', 'MODIFICATEUR_VALUE', 'MODIFICATEUR_CATEGORIE_ID'));
        $this->addToHtml = $addToHtml;
    }
    
    public function build(){
        $output = '';
        $output .= '<table>';
        
        $oldCat = '';
        foreach ($this->view AS $l){
            if($oldCat != $l['MODIFICATEUR_CATEGORIE']){
                $oldCat = $l['MODIFICATEUR_CATEGORIE'];
                $output .= '<tr class="header">';
                $output .= '<td colspan=3 class="centerCell">'.$l['MODIFICATEUR_CATEGORIE'].'</td>';
                $output .= '</tr>';
            }
            $output .= '<tr>';
            $selected = '';
            if($l['MODIFICATEUR_DEFAUT'] == 1){
                $selected = ' checked="checked" ';
            }
            $output .= '<td width=20><input '.$this->addToHtml.' type="radio" '.$selected.' name="'.$l['MODIFICATEUR_CATEGORIE_ID'].'" id="'.$l['MODIFICATEUR_CATEGORIE_ID'].'" value="'.$l['id'].'"></td>';
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
