<?php

namespace polarisapi\data;

use polarisapi\data\attribut\Attribut;

class JetCarac{
    public static function getSuccessPorcent($attributCode = null, $attributId = null, $joueurId, $difficulte = 0, $margeAdv = 0){
        $attribut = Attribut::getAttribut($joueurId, $attributCode, $attributId);
        
        $retour = array();
        $valeur = $attribut->getFinalValue();
        
        $bonus = 0;
        $diff = ($valeur-$margeAdv) - $difficulte;
        if($diff < 0){
            $bonus = $diff*5;
        }
        
        
        $retour['Valeur carac. de base'] = $valeur;
        if($margeAdv > 0){
            
            $retour['Duel : marge adverse cumulée'] = $margeAdv;
            $retour['Valeur modifiée'] = $valeur-$margeAdv;
        }
        $retour['Malus inhérent'] = $bonus;
        $retour['total'] = 99+$bonus;
        
        if($retour['total'] < 1){
            $retour['total'] = 1;
        }
        
        return $retour;
    }
}

