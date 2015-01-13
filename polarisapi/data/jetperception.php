<?php

namespace polarisapi\data;

use polarisapi\data\attribut\Attribut;

class JetPerception{
    public static function getSuccessPorcent($attributCode = null, $attributId = null, $joueurId, $diffSupp, $diffBase, $mods = array()){
        $attribut = Attribut::getAttribut($joueurId, $attributCode, $attributId);
        
        $adb = Attribut::getAttribut($diffBase, 'MODIFICATEUR_VALUE');
        
        $difficulte = $adb->getFinalValue()+$diffSupp;
        foreach($mods AS $mod){
            $amod = Attribut::getAttribut($mod, 'MODIFICATEUR_VALUE');
            $difficulte += $amod->getFinalValue();
        }
        
        $retour = array();
        $valeur = $attribut->getFinalValue();
        
        $bonus = 0;
        $diff = $valeur - $difficulte;
        if($diff < 0){
            $bonus = $diff*5;
        }
        
        
        $retour['Difficulté'] = $difficulte;
        $retour['Valeur carac. de base'] = $valeur;
        $retour['Malus inhérent'] = $bonus;
        $retour['total'] = 99+$bonus;
        
        if($retour['total'] < 1){
            $retour['total'] = 1;
        }
        
        return $retour;
    }
}

