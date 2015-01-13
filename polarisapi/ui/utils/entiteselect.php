<?php

namespace polarisapi\ui\utils;

use jin\query\Query;
use jin\query\QueryResult;

class EntiteSelect{
    private $currentValue;
    private $labelKey;
    private $entiteType;
    private $formName;
    private $addToHtml;
    
    public function __construct($entiteType, $formName, $labelKey, $currentValue = null, $addToHtml = '') {
        $this->currentValue = $currentValue;
        $this->entiteType = $entiteType;
        $this->formName = $formName;
        $this->labelKey = $labelKey;
        $this->addToHtml = $addToHtml;
    }
    
    public function build(){
        $q = new Query();
        $q->setRequest('SELECT e.*, v.tt_valeur AS label '
                . 'FROM entite AS e '
                . 'JOIN entitetype AS et ON et.pk_entitetype = e.fk_entitetype AND et.tt_code='.$q->argument($this->entiteType, Query::$SQL_STRING).' '
                . 'JOIN attribut AS a ON a.fk_entitetype = et.pk_entitetype AND a.tt_code='.$q->argument($this->labelKey, Query::$SQL_STRING).' '
                . 'LEFT JOIN valeur AS v ON v.fk_attribut = a.pk_attribut AND v.fk_entite = e.pk_entite'); 
        $q->addToRequest('ORDER BY v.tt_valeur ASC');
        $q->execute();
        $attributs = $q->getQueryResults();
        
        $output = '';
        $output .= '<select '.$this->addToHtml.' id="'.$this->formName.'" name="'.$this->formName.'">';
        foreach($attributs AS $attr){
            $output .= '<option ';
            if($this->currentValue == $attr['pk_entite']){
                $output .= 'selected="selected" ';
            }
            $output .= 'value="'.$attr['pk_entite'].'">'.$attr['label'].'</option>';
        }
        $output .= '</select>';

        return $output;
    }
}

