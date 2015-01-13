<?php

namespace polarisapi\ui\utils;

use jin\query\Query;
use jin\query\QueryResult;
use jin\lang\StringTools;
use jin\lang\ArrayTools;

class AttributSelect{
    private $currentValue;
    private $modifiable;
    private $modificateur;
    private $entiteType;
    private $formName;
    private $onChange;
    private $addToHtml;
    private $categories;
    
    public function __construct($entiteType, $formName, $currentValue = null, $modifiable = null, $modificateur = null, $jet = null, $addToHtml = '', $categories = array()) {
        $this->currentValue = $currentValue;
        $this->modifiable = $modifiable;
        $this->modificateur = $modificateur;
        $this->entiteType = $entiteType;
        $this->formName = $formName;
        $this->jet = $jet;
        $this->addToHtml = $addToHtml;
        $this->categories = $categories;
    }
    
    public function build(){
        $q = new Query();
        $q->setRequest('SELECT a.*, c.tt_designation AS groupe FROM attribut AS a '
                . 'JOIN entitetype AS et ON et.pk_entitetype = a.fk_entitetype '
                . 'LEFT JOIN categorie AS c ON c.pk_categorie = a.fk_categorie '
                . 'WHERE et.tt_code='.$q->argument($this->entiteType, Query::$SQL_STRING).' ');
        if(!is_null($this->modifiable)){
            $q->addToRequest('AND a.in_modifiable='.$q->argument($this->modifiable, Query::$SQL_NUMERIC));
        }
        if(!is_null($this->modificateur)){
            $q->addToRequest('AND a.in_modificateur='.$q->argument($this->modificateur, Query::$SQL_NUMERIC));
        }
        if(!is_null($this->jet)){
            $q->addToRequest('AND a.in_jet='.$q->argument($this->jet, Query::$SQL_NUMERIC));
        }
        if(!empty($this->categories)){
            $list = '\''.ArrayTools::toList($this->categories, '\',\'').'\'';
            $q->addToRequest('AND c.tt_code IN ('.$list.')');
        }
        
        $q->addToRequest('ORDER BY a.pk_attribut ASC');
        $q->execute();
        $attributs = $q->getQueryResults();
        
        $output = '';
        $output .= '<select '.$this->addToHtml.' id="'.$this->formName.'" name="'.$this->formName.'">';
        $oldGroup = null;
        foreach($attributs AS $attr){
            if($oldGroup != $attr['groupe']){
                if(!is_null($oldGroup)){
                    $output .= '</optgroup>';
                }
                $oldGroup = $attr['groupe'];
                $output .= '<optgroup label="'.$oldGroup.'">';
            }
            $output .= '<option ';
            if($this->currentValue == $attr['pk_attribut']){
                $output .= 'selected="selected" ';
            }
            $output .= 'value="'.$attr['pk_attribut'].'">'.$attr['tt_designation'].'</option>';
        }
        $output .= '</optgroup>';
        $output .= '</select>';

        return $output;
    }
}

