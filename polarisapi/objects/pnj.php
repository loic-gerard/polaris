<?php

namespace polarisapi\objects;

use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\data\attribut\Attribut;
use polarisapi\objects\GlobalPlayer;

class Pnj extends GlobalPlayer{

    public function __construct($id) {
	parent::__construct($id);
	$this->type = 'PNJ_';
    }
    
    public function getType(){
	return 'PNJ';
    }
    
    public function getResArmeDistance(){
	$a = Attribut::getAttribut($this->id, $this->type.'RES_ARME');
	return $a->getFinalValue();
    }
    
    public function getParerArmeDistance(){
	$a = Attribut::getAttribut($this->id, $this->type.'PARADE');
	return ($a->getFinalValue()-1)*10;
    }
    
    public function getEsquiveArmeDistance(){
	$a = Attribut::getAttribut($this->id, $this->type.'ESQUIVE');
	return ($a->getFinalValue()-1)*10;
    }
    
    public function getTalentNameArmeDistance(){
	return 'Attaque par défaut';
    }
    
    public function getTalentValueArmeDistance(){
	$a = Attribut::getAttribut($this->id, $this->type.'ATTAQUE');
	return ($a->getFinalValue()-1)*10;
    }
    
    public function getResArmeContact(){
	$a = Attribut::getAttribut($this->id, $this->type.'RES_ARME');
	return $a->getFinalValue();
    }
    
    
}

