<?php

namespace polarisapi\objects;

use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\data\attribut\Attribut;
use jin\lang\NumberTools;
use jin\lang\ArrayTools;
use polarisapi\objects\GlobalPlayer;
use polarisapi\data\View;

class Player extends GlobalPlayer{
    
    private $armesDistance;
    
    public function __construct($id) {
	parent::__construct($id);
	$this->type = '';
	
	$this->armesDistance = new View('ARMEDISTANCE', 'pk_entite', 'ASC', '', array('ARMEDISTANCE_DESIGNATION', 'ARMEDISTANCE_TYPE', 'ARMEDISTANCE_MILIEU', 'ARMEDISTANCE_DEGATSPHYS', 'ARMEDISTANCE_DEGATSCHOC', 'ARMEDISTANCE_PORTEE1', 'ARMEDISTANCE_PORTEE2', 'ARMEDISTANCE_PORTEE3', 'ARMEDISTANCE_PORTEE4', 'ARMEDISTANCE_CADENCE', 'ARMEDISTANCE_MUNITIONS', 'ARMEDISTANCE_EQUIPED', 'ARMEDISTANCE_RESISTANCE', 'ARMEDISTANCE_TALENT'), $id);
    }
    
    public function getType(){
	return 'PJ';
    }
    
    public function getResArmeDistance(){
	return $this->armesDistance->getSumValue('ARMEDISTANCE_RESISTANCE', 'ARMEDISTANCE_EQUIPED');
    }
    
    
    
    public function getParerArmeDistance(){
	$talent = $this->armesDistance->getSelectedValue('ARMEDISTANCE_TALENT', 'ARMEDISTANCE_EQUIPED');
	
	$a = Attribut::getAttribut($this->id, $talent);
	return $a->getFinalValue();
    }
    
    public function getEsquiveArmeDistance(){
	$a = Attribut::getAttribut($this->id, 'TALENT_ESQUIVE');
	return $a->getFinalValue();
    }
    
    public function getTalentNameArmeDistance(){
	$talent = $this->armesDistance->getSelectedValue('ARMEDISTANCE_TALENT', 'ARMEDISTANCE_EQUIPED');
	
	$a = Attribut::getAttribut($this->id, $talent);
	
	return $a->getAttributName();
    }
    
    public function getTalentValueArmeDistance(){
	$talent = $this->armesDistance->getSelectedValue('ARMEDISTANCE_TALENT', 'ARMEDISTANCE_EQUIPED');
	
	$a = Attribut::getAttribut($this->id, $talent);
	
	return $a->getFinalValue();
    }
    
    public function getResArmeContact(){
	
    }
}

