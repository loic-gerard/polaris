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
    
    public function getResArmeCorpsACorps(){
	$a = Attribut::getAttribut($this->id, $this->type.'RES_ARME');
	return $a->getFinalValue();
    }
    
    public function getParerArmeDistance(){
	$a = Attribut::getAttribut($this->id, $this->type.'PARADE');
	return ($a->getFinalValue()-1)*10;
    }
    
    public function getParerArmeCorpsACorps(){
	$a = Attribut::getAttribut($this->id, $this->type.'PARADE');
	return ($a->getFinalValue()-1)*10;
    }
    
    public function getEsquiveArmeDistance(){
	$a = Attribut::getAttribut($this->id, $this->type.'ESQUIVE');
	return ($a->getFinalValue()-1)*10;
    }
    
    public function getEsquiveArmeCorpsACorps(){
	$a = Attribut::getAttribut($this->id, $this->type.'ESQUIVE');
	return ($a->getFinalValue()-1)*10;
    }
    
    public function getTalentNameArmeDistance(){
	return 'Attaque par défaut';
    }
    
    public function getTalentNameArmeCorpsACorps(){
	return 'Attaque par défaut';
    }
    
    public function getTalentValueArmeDistance(){
	$a = Attribut::getAttribut($this->id, $this->type.'ATTAQUE');
	return ($a->getFinalValue()-1)*10;
    }
    
    public function getTalentValueArmeCorpsACorps(){
	$a = Attribut::getAttribut($this->id, $this->type.'ATTAQUE');
	return ($a->getFinalValue()-1)*10;
    }
    
    public function resolveDegatsOnProtection($nb){
        //Rien à faire
    }
    
    public function resolveMunitionsArmeDistance($nb){
        //Rien à faire
    }
    
    public function isArmeDistance(){
        return true;
    }
    
    public function isArmeCorpsACorps(){
        return true;
    }
    
    public function getArmeDistanceMunitions(){
        return 100;
    }
    
    
    public function getProtection(){
        $a = Attribut::getAttribut($this->id, $this->type.'ARMURE');
	return (int)$a->getFinalValue();
    }
    
    public function getNiveauEsquive(){
        $a = Attribut::getAttribut($this->id, $this->type.'PARADE');
	return ($a->getFinalValue());
    }
    
    public function getArmeDistancename(){
	return 'Arme de base';
    }
    
    public function getArmeCorpsACorpsName(){
	return 'Arme de base';
    }
    
    public function getBonusDegats(){
        return 0;
    }
    
    public function getArmeDistanceDegatsPhysiques(){
	$a = Attribut::getAttribut($this->id, $this->type.'DEGATS_PHYS');
	return ($a->getFinalValue());
    }
    
    public function getArmeDistanceDegatsChoc(){
	$a = Attribut::getAttribut($this->id, $this->type.'DEGATS_CHOC');
	return ($a->getFinalValue());
    }
    
    public function getArmeCorpsACorpsDegatsPhysiques(){
	$a = Attribut::getAttribut($this->id, $this->type.'DEGATS_PHYS');
	return ($a->getFinalValue());
    }
    
    public function getArmeCorpsACorpsDegatsChoc(){
	$a = Attribut::getAttribut($this->id, $this->type.'DEGATS_CHOC');
	return ($a->getFinalValue());
    }
    
    public function getArmeDistanceCadence(){
        $a = Attribut::getAttribut($this->id, $this->type.'NBATTAQUES');
	return ($a->getFinalValue());
    }
    
    public function getSeuil($code){
        $a = Attribut::getAttribut($this->id, 'PNJ_SEUIL_'.$code);
        return $a->getFinalValue();
    }
    
    public function getArmeDistancePortees(){

        $portees = array();
        $portees[] = 'Bout portant';
        $portees[] = 'Portée courte';
        $portees[] = 'Portée moyenne';
        $portees[] = 'Portée longue';
        $portees[] = 'Portée extrême';
        
        return $portees;
    }
    
    public function getArmeDistancePorteeName($i){
        $portees = $this->getArmeDistancePortees();
        return $portees[$i];
    }
    
    
    
}

