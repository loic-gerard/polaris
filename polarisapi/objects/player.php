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
    private $armesCorpsACorps;
    private $protections;
    
    public function __construct($id) {
	parent::__construct($id);
	$this->type = '';
	
	$this->armesDistance = new View('ARMEDISTANCE', 'pk_entite', 'ASC', '', array('ARMEDISTANCE_DESIGNATION', 'ARMEDISTANCE_TYPE', 'ARMEDISTANCE_MILIEU', 'ARMEDISTANCE_DEGATSPHYS', 'ARMEDISTANCE_DEGATSCHOC', 'ARMEDISTANCE_PORTEE1', 'ARMEDISTANCE_PORTEE2', 'ARMEDISTANCE_PORTEE3', 'ARMEDISTANCE_PORTEE4', 'ARMEDISTANCE_CADENCE', 'ARMEDISTANCE_MUNITIONS', 'ARMEDISTANCE_EQUIPED', 'ARMEDISTANCE_RESISTANCE', 'ARMEDISTANCE_TALENT'), $id);
        $this->armesCorpsACorps = new View('ARMECORPSACORPS', 'pk_entite', 'ASC', '', array('ARMECORPSACORPS_DESIGNATION','ARMECORPSACORPS_TYPE','ARMECORPSACORPS_TALENT','ARMECORPSACORPS_DEGATSPHYS','ARMECORPSACORPS_DEGATSCHOC','ARMECORPSACORPS_RESISTANCE', 'ARMECORPSACORPS_EQUIPED'), $id);
        $this->protections = new View('PROTECTION', 'pk_entite', 'ASC', '', array('PROTECTION_DESIGNATION', 'PROTECTION_LOCALISATION', 'PROTECTION_PROTECTION', 'PROTECTION_RESISTANCE','PROTECTION_SPECIAL','PROTECTION_USURE','PROTECTION_EQUIPED'), $id);

    }
    
    public function addFatigue(){
	$a = Attribut::getAttribut($this->id, 'FATIGUE');
	$av = $a->getFinalValue();

	
	$max = $a->evaluateExpression($a->getData('max'));
	if($av < $max){
	    $av += 1;
	}
	
	$a->setValue($av);
    }
    
    public function removeFatigue(){
	$a = Attribut::getAttribut($this->id, 'FATIGUE');
	$av = $a->getFinalValue();
	
	if($av > 0){
	    $av -= 1;
	}
	
	$a->setValue($av);
    }
    
    public function getType(){
	return 'PJ';
    }
    
    public function getResArmeDistance(){
	return $this->armesDistance->getSumValue('ARMEDISTANCE_RESISTANCE', 'ARMEDISTANCE_EQUIPED');
    }
    
    public function getResArmeCorpsACorps(){
	return $this->armesCorpsACorps->getSumValue('ARMECORPSACORPS_RESISTANCE', 'ARMECORPSACORPS_EQUIPED');
    }
    
    
    public function getParerArmeDistance(){
	$talent = $this->armesDistance->getSelectedValue('ARMEDISTANCE_TALENT', 'ARMEDISTANCE_EQUIPED');
	
	$a = Attribut::getAttribut($this->id, $talent);
	return $a->getFinalValue();
    }
    
    public function getParerArmeCorpsACorps(){
        $talent = $this->armesCorpsACorps->getSelectedValue('ARMECORPSACORPS_TALENT', 'ARMECORPSACORPS_EQUIPED');
	
	$a = Attribut::getAttribut($this->id, $talent);
	return $a->getFinalValue();
    }
    
    public function getArmeDistancename(){
	return $this->armesDistance->getSelectedValue('ARMEDISTANCE_DESIGNATION', 'ARMEDISTANCE_EQUIPED');
    }
    
    public function getArmeCorpsACorpsName(){
	return $this->armesCorpsACorps->getSelectedValue('ARMECORPSACORPS_DESIGNATION', 'ARMECORPSACORPS_EQUIPED');
    }
    
    public function getArmeDistanceDegatsPhysiques(){
	return $this->armesDistance->getSelectedValue('ARMEDISTANCE_DEGATSPHYS', 'ARMEDISTANCE_EQUIPED');
    }
    
    public function getArmeCorpsACorpsDegatsPhysiques(){
	return $this->armesCorpsACorps->getSelectedValue('ARMECORPSACORPS_DEGATSPHYS', 'ARMECORPSACORPS_EQUIPED');
    }
    
    public function getArmeDistancePortees(){
        $portees = array();
        $portees[] = 'Bout portant';
        $portees[] = $this->armesDistance->getSelectedValue('ARMEDISTANCE_PORTEE1', 'ARMEDISTANCE_EQUIPED');
        $portees[] = $this->armesDistance->getSelectedValue('ARMEDISTANCE_PORTEE2', 'ARMEDISTANCE_EQUIPED');
        $portees[] = $this->armesDistance->getSelectedValue('ARMEDISTANCE_PORTEE3', 'ARMEDISTANCE_EQUIPED');
        $portees[] = $this->armesDistance->getSelectedValue('ARMEDISTANCE_PORTEE4', 'ARMEDISTANCE_EQUIPED');
        
        return $portees;
    }
    
    public function getArmeDistancePorteeName($i){
        $portees = $this->getArmeDistancePortees();
        return $portees[$i];
    }
    
    public function getProtection(){
        $sum = $this->protections->getSumValue('PROTECTION_PROTECTION', 'PROTECTION_EQUIPED');
        return round($sum / 4);
    }
    public function getArmeDistanceDegatsChoc(){
	return $this->armesDistance->getSelectedValue('ARMEDISTANCE_DEGATSCHOC', 'ARMEDISTANCE_EQUIPED');
    }
    
    public function getArmeCorpsAcorpsDegatsChoc(){
	return $this->armesCorpsACorps->getSelectedValue('ARMECORPSACORPS_DEGATSCHOC', 'ARMECORPSACORPS_EQUIPED');
    }
    
    public function getSeuil($code){
        $a = Attribut::getAttribut($this->id, 'SEUIL_'.$code);
        return $a->getFinalValue();
    }
    
    public function getArmeDistanceCadence(){
	return $this->armesDistance->getSelectedValue('ARMEDISTANCE_CADENCE', 'ARMEDISTANCE_EQUIPED');
    }
    
    public function getBonusDegats(){
        $a = Attribut::getAttribut($this->id, 'BONUSDEGATS');
        $av = $a->getFinalValue();
        
        if($av >= 1 && $av <= 6){
            return -3;
        }
        if($av >= 7 && $av <= 9){
            return -2;
        }
        if($av >= 10 && $av <= 12){
            return -1;
        }
        if($av >= 13 && $av <= 15){
            return 0;
        }
        if($av >= 16 && $av <= 18){
            return 1;
        }
        if($av >= 19 && $av <= 21){
            return 2;
        }
        if($av >= 22 && $av <= 24){
            return 3;
        }
        if($av >= 25 && $av <= 28){
            return 4;
        }
        if($av >= 29 && $av <= 33){
            return 5;
        }
        if($av >= 34 && $av <= 39){
            return 6;
        }
        if($av >= 40 && $av <= 46){
            return 7;
        }
        if($av >= 47 && $av <= 54){
            return 8;
        }
        if($av >= 55 && $av <= 63){
            return 9;
        }
        if($av >= 64 && $av <= 73){
            return 10;
        }
        if($av >= 74 && $av <= 84){
            return 11;
        }
        if($av >= 85 && $av <= 96){
            return 12;
        }
        if($av >= 97 && $av <= 109){
            return 13;
        }
        if($av >= 110 && $av <= 124){
            return 14;
        }
        
        
	return 15;
    }
    
    public function getEsquiveArmeDistance(){
	$a = Attribut::getAttribut($this->id, 'TALENT_ESQUIVE');
	return $a->getFinalValue();
    }
    
    public function getEsquiveArmeCorpsACorps(){
	$a = Attribut::getAttribut($this->id, 'TALENT_ESQUIVE');
	return $a->getFinalValue();
    }
    
    public function getTalentNameArmeDistance(){
	$talent = $this->armesDistance->getSelectedValue('ARMEDISTANCE_TALENT', 'ARMEDISTANCE_EQUIPED');
	
	$a = Attribut::getAttribut($this->id, $talent);
	
	return $a->getAttributName();
    }
    
    public function getTalentNameArmeCorpsACorps(){
	$talent = $this->armesCorpsACorps->getSelectedValue('ARMECORPSACORPS_TALENT', 'ARMECORPSACORPS_EQUIPED');
	
	$a = Attribut::getAttribut($this->id, $talent);
	
	return $a->getAttributName();
    }
    
    public function getTalentValueArmeDistance(){
	$talent = $this->armesDistance->getSelectedValue('ARMEDISTANCE_TALENT', 'ARMEDISTANCE_EQUIPED');
	
	$a = Attribut::getAttribut($this->id, $talent);
	
	return $a->getFinalValue();
    }
    
    public function getTalentValueArmeCorpsACorps(){
	$talent = $this->armesCorpsACorps->getSelectedValue('ARMECORPSACORPS_TALENT', 'ARMECORPSACORPS_EQUIPED');
	
	$a = Attribut::getAttribut($this->id, $talent);
	
	return $a->getFinalValue();
    }
    
    public function getTalentCodeArmeCorpsACorps(){
	$talent = $this->armesCorpsACorps->getSelectedValue('ARMECORPSACORPS_TALENT', 'ARMECORPSACORPS_EQUIPED');
	
	
	return $talent;
    }
    
    public function getTalentCodeArmeDistance(){
	$talent = $this->armesDistance->getSelectedValue('ARMEDISTANCE_TALENT', 'ARMEDISTANCE_EQUIPED');
	
	
	return $talent;
    }
    

    

    
    public function getNiveauEsquive(){
        $a = Attribut::getAttribut($this->id, 'TALENT_ESQUIVE');
	return $a->getNiveau();
    }
    
    public function resolveMunitionsArmeDistance($nb){
        foreach ($this->armesDistance AS $p){
            $a = Attribut::getAttribut($p['id'], 'ARMEDISTANCE_EQUIPED');
            if($a->getFinalValue() == 1){
                $a = Attribut::getAttribut($p['id'], 'ARMEDISTANCE_MUNITIONS');
                $av = $a->getFinalValue() - $nb;
                if($av < 0){
                    $av = 0;
                }
                $a->setValue($av);
            }
        }
    }
    
    public function isArmeDistance(){
        foreach ($this->armesDistance AS $p){
            $a = Attribut::getAttribut($p['id'], 'ARMEDISTANCE_EQUIPED');
            if($a->getFinalValue() == 1){
                return true;
            }
        }
        return false;
    }
    
    public function isArmeCorpsACorps(){
        foreach ($this->armesCorpsACorps AS $p){
            $a = Attribut::getAttribut($p['id'], 'ARMECORPSACORPS_EQUIPED');
            if($a->getFinalValue() == 1){
                return true;
            }
        }
        return false;
    }
    
    public function getArmeDistanceMunitions(){
        return $this->armesDistance->getSumValue('ARMEDISTANCE_MUNITIONS');
    }
    
    public function resolveDegatsOnProtection($nb){
	$p = $this->getProtection();
	if($p == 0){
	    return 0;
	}
        $nbf = NumberTools::floor($nb/$p);
        
        foreach($this->protections AS $p){
            $a = Attribut::getAttribut($p['id'], 'PROTECTION_RESISTANCE');
            $av = $a->getFinalValue();
            $av = $av - $nbf;
            if($av < 0){
                $av = 0;
            }
            $a->setValue($av);
        }
    }
}

