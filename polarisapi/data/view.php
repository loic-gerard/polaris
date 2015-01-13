<?php

namespace polarisapi\data;

use jin\query\Query;
use jin\query\QueryResult;
use jin\lang\StringTools;
use jin\log\Debug;
use \Iterator;

class View implements Iterator{
    private $datas = array();
    private $attributs = array();
    private $entiteType;
    private $parent;
    
    public function __construct($entiteType, $orderBy = null, $orderBySens = 'ASC', $condition = '', $attributs = array(), $parentEntite = null) {
        $this->attributs = $attributs;
        $this->entiteType = $entiteType;
        $this->parent = $parentEntite;
        
        $q = new Query();
        $q->setRequest('SELECT e.pk_entite ');
        foreach($attributs AS $attribut){
            $q->addToRequest(',v_'.$attribut.'.tt_valeur AS val_'.$attribut);
            $q->addToRequest(',a_'.$attribut.'.tt_type AS type_'.$attribut);
        }
        $q->addToRequest('FROM entite AS e '
                . 'JOIN entitetype AS et ON et.pk_entitetype = e.fk_entitetype AND et.tt_code='.$q->argument($entiteType, Query::$SQL_STRING));
        foreach($attributs AS $attribut){
            $q->addToRequest('LEFT JOIN attribut AS a_'.$attribut.' ON a_'.$attribut.'.tt_code='.$q->argument($attribut, Query::$SQL_STRING).' '
                . 'LEFT JOIN valeur AS v_'.$attribut.' ON v_'.$attribut.'.fk_entite = e.pk_entite AND a_'.$attribut.'.pk_attribut = v_'.$attribut.'.fk_attribut ');
        }
        $q->addToRequest('WHERE 1=1');
        if($condition != ''){
            $q->addToRequest('AND '.$condition);
        }
        if($this->parent){
            $q->addToRequest('AND e.fk_entite='.$q->argument($this->parent, Query::$SQL_NUMERIC));
        }
        if($orderBy){
            $q->addToRequest('ORDER BY '.$orderBy.' '.$orderBySens);
        }
        $q->execute();
        $qr = $q->getQueryResults();
        
        foreach($qr AS $r){
            $l = array();
            $l['id'] = $r['pk_entite'];
            
            foreach ($attributs AS $attribut){
                $type = StringTools::firstCarToUpperCase($r['type_'.$attribut]);
                $className = 'polarisapi\data\attribut\\' . $type;
		$c = new $className($r['pk_entite'], $attribut, $r['val_'.$attribut]);
                $l[$attribut] = $c->getValue();
            }
            
            $this->datas[] = $l;
        }
    }
    
    public function getParentEntite(){
        return $this->parent;
    }
    
    public function getEntiteType(){
        return $this->entiteType;
    }
    
    public function getDatas(){
        return $this->datas;
    }
    
    public function getAttributs(){
        return $this->attributs;
    }
    
    public function count(){
	return count($this->datas);
    }
    
    public function getSumValue($key, $selectedOnly = null){
	$total = 0;
	foreach($this->datas AS $d){
	    if($selectedOnly){
		if($d[$selectedOnly] == 1){
		     $total .= $d[$key];
		}
	    }else{
		 $total .= $d[$key];
	    }
	   
	}
	
	return $total;
    }
    
    public function getSelectedValue($key, $selectedOnly){
	foreach($this->datas AS $d){
	    if($d[$selectedOnly] == 1){
		return $d[$key];
	    }
	}
    }
    
    //Fonctions d'itération

    /**
     * Itération : current
     * @return mixed
     */
    public function current() {
        return current($this->datas);
    }


    /**
     * Itération : key
     * @return string
     */
    public function key() {
        return key($this->datas);
    }


    /**
     * Itération : rewind
     * @return \jin\query\QueryResult
     */
    public function rewind() {
        reset($this->datas);
        return $this;
    }


    /**
     * Itération : next
     */
    public function next() {
        next($this->datas);
    }


    /**
     * Itération valid
     * @return boolean
     */
    public function valid() {
        return array_key_exists(key($this->datas), $this->datas);
    }
}