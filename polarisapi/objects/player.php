<?php

namespace polarisapi\objects;

use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\data\attribut\Attribut;

class Player{
    private $id;
    
    public function __construct($id) {
        $this->id = $id;
    }
    
    public function addBlessure($nb){
        $retour = array();
        $retour['typeblessure'] = 'Aucune';
        
        //Récupération des seuils
        $seuils = array();
        $seuils[] = array('blessAttribut' => Attribut::getAttribut($_POST['joueur'], 'BLESSURE_LEGERE'),'attribut' => Attribut::getAttribut($_POST['joueur'], 'SEUIL_LEGERE'), 'code' => 'LEGERE');
        $seuils[] = array('blessAttribut' => Attribut::getAttribut($_POST['joueur'], 'BLESSURE_GRAVE'),'attribut' => Attribut::getAttribut($_POST['joueur'], 'SEUIL_GRAVE'), 'code' => 'GRAVE');
        $seuils[] = array('blessAttribut' => Attribut::getAttribut($_POST['joueur'], 'BLESSURE_CRITIQUE'),'attribut' => Attribut::getAttribut($_POST['joueur'], 'SEUIL_CRITIQUE'), 'code' => 'CRITIQUE');
        $seuils[] = array('blessAttribut' => Attribut::getAttribut($_POST['joueur'], 'BLESSURE_FATAL'),'attribut' => Attribut::getAttribut($_POST['joueur'], 'SEUIL_FATAL'), 'code' => 'FATAL');
        $seuils[] = array('blessAttribut' => Attribut::getAttribut($_POST['joueur'], 'BLESSURE_MORT'),'attribut' => Attribut::getAttribut($_POST['joueur'], 'SEUIL_MORT'), 'code' => 'MORT');

        $bless = $_POST['blessure'];
        $i = null;
        $ci = 0;
        foreach($seuils as $seuil){
            if($bless > $seuil['attribut']->getFinalValue()){
                $i = $ci;
            }
            $ci++;
        }
        $startI = $i;
        
        $found = false;
        for($i = $startI; $i < count($seuils); $i++){
            //Teste si on est déjà au max
            $max = $seuils[$i]['blessAttribut']->evaluateExpression($seuils[$i]['blessAttribut']->getData('max'));
            if($seuils[$i]['blessAttribut']->getFinalValue() < $max){
                $seuils[$i]['blessAttribut']->setValue($seuils[$i]['blessAttribut']->getFinalValue()+1);
                $retour['typeblessure'] = $seuils[$i]['code'];
                $found = true;
                break;
            }
        }
        
        return $retour;
    }
}

