<?php

namespace polarisapi\data;

use polarisapi\data\attribut\Attribut;

class JetTalent{
    public static function getSuccessPorcent($attributCode = null, $attributId = null, $joueurId, $difficulte = 0){
        $attribut = Attribut::getAttribut($joueurId, $attributCode, $attributId);
        
        $retour = array();
        $basePorcent = $attribut->getFinalValue();
        $niveau = $attribut->getNiveau();
        
        if($difficulte == 0){
            $bonus = 0;
        }else{
            if($niveau > $difficulte){
                $diff = $niveau - $difficulte;

                $tab = array();
                $tab[0] = 10;
                $tab[5] = 20;
                $tab[7] = 30;
                $tab[10] = 35;
                $tab[14] = 40;
                $tab[19] = 45;
                $tab[25] = 50;
                $tab[32] = 55;

                foreach ($tab AS $tk => $tv){
                    if($diff > $tk){
                        $bonus = $tv;
                    }
                }
            }else if($niveau < $difficulte){
                $diff = $difficulte - $niveau;
                $bonus = $diff * -5;
            }else{
                $bonus = 0;
            }
        }
        
        $retour['Pourcentage talent'] = $basePorcent;
        $retour['Bonus'] = $bonus;
        $retour['total'] = $basePorcent+$bonus;
        
        return $retour;
    }
}

