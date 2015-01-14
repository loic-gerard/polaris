<?php

namespace polarisapi\objects;

use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\data\attribut\Attribut;
use jin\lang\NumberTools;
use jin\lang\ArrayTools;

class GlobalPlayer {

    protected $id;
    protected $type;

    public function __construct($id) {
        $this->id = $id;
    }

    public function addBlessure($nbPhys, $nbChoc) {
        $retour = array();
        $retour['blessures'] = array();
        $retour['jets'] = array();

        if ($nbPhys) {
            $r = $this->addUnitBlessure($nbPhys);
            $retour['blessures'] = ArrayTools::merge($retour['blessures'], $r['blessures']);
            $retour['jets'] = ArrayTools::merge($retour['jets'], $r['jets']);
        }

        if ($nbChoc) {
            $seuil_inconscience = Attribut::getAttribut($this->id, $this->type . 'SEUIL_INCONSCIENCE');
            $nbBlessInsconscience = NumberTools::floor($nbChoc / $seuil_inconscience->getFinalValue());

            if ($nbBlessInsconscience > 0) {
                for ($i = 0; $i < $nbBlessInsconscience; $i++) {
                    $r = $this->addUnitBlessure(0, true);
                    $retour['blessures'] = ArrayTools::merge($retour['blessures'], $r['blessures']);
                    $retour['jets'] = ArrayTools::merge($retour['jets'], $r['jets']);
                }
            }

            //Test si jet nécessaire
            $sia = Attribut::getAttribut($this->id, $this->type . 'SEUIL_INCONSCIENCE');
            $si = $sia->getFinalValue();

            $va = Attribut::getAttribut($this->id, $this->type . 'VOL');
            $v = $va->getFinalValue();

            if ($si >= 4 && $si <= 5) {
                $retour['jets'][] = 'Jet volonté 5x (' . ($v * 5) . '%) ou inconscience';
            }
            if ($si >= 6 && $si <= 7) {
                $retour['jets'][] = 'Jet volonté 4x (' . ($v * 4) . '%) ou inconscience';
            }
            if ($si >= 8 && $si <= 9) {
                $retour['jets'][] = 'Jet volonté 3x (' . ($v * 3) . '%) ou inconscience';
            }
            if ($si >= 10 && $si <= 11) {
                $retour['jets'][] = 'Jet volonté 2x (' . ($v * 2) . '%) ou inconscience';
            }
            if ($si >= 12) {
                $retour['jets'][] = 'Jet volonté 1x (' . ($v * 1) . '%) ou inconscience';
            }
        }

        return $retour;
    }

    private function addUnitBlessure($nb, $inconscience = false) {
        $retour['blessures'] = array();
        $retour['jets'] = array();

        //Récupération des seuils
        $seuils = array();
        if ($inconscience) {
            $seuils[] = array('blessAttribut' => Attribut::getAttribut($this->id, $this->type . 'BLESSURE_INCONSCIENCE'), 'attribut' => Attribut::getAttribut($this->id, $this->type . 'SEUIL_INCONSCIENCE'), 'code' => 'INCONSCIENCE');
        }
        $seuils[] = array('blessAttribut' => Attribut::getAttribut($this->id, $this->type . 'BLESSURE_LEGERE'), 'attribut' => Attribut::getAttribut($this->id, $this->type . 'SEUIL_LEGERE'), 'code' => 'LEGERE');
        $seuils[] = array('blessAttribut' => Attribut::getAttribut($this->id, $this->type . 'BLESSURE_GRAVE'), 'attribut' => Attribut::getAttribut($this->id, $this->type . 'SEUIL_GRAVE'), 'code' => 'GRAVE');
        $seuils[] = array('blessAttribut' => Attribut::getAttribut($this->id, $this->type . 'BLESSURE_CRITIQUE'), 'attribut' => Attribut::getAttribut($this->id, $this->type . 'SEUIL_CRITIQUE'), 'code' => 'CRITIQUE');
        $seuils[] = array('blessAttribut' => Attribut::getAttribut($this->id, $this->type . 'BLESSURE_FATAL'), 'attribut' => Attribut::getAttribut($this->id, $this->type . 'SEUIL_FATAL'), 'code' => 'FATAL');
        $seuils[] = array('blessAttribut' => Attribut::getAttribut($this->id, $this->type . 'BLESSURE_MORT'), 'attribut' => Attribut::getAttribut($this->id, $this->type . 'SEUIL_MORT'), 'code' => 'MORT');



        $bless = $nb;
        $i = null;
        $ci = 0;
        foreach ($seuils as $seuil) {
            if ($inconscience) {
                if ($seuil['code'] == 'INCONSCIENCE') {
                    $i = $ci;
                }
            } else {
                $tv = (int) $seuil['attribut']->getFinalValue();

                if ($bless > $tv) {
                    $i = $ci;
                }
            }

            $ci++;
        }
        $startI = $i;
        
        if (!is_null($startI)) {

            $found = false;
            
            for ($i = $startI; $i < count($seuils); $i++) {
                //Teste si on est déjà au max
                $max = $seuils[$i]['blessAttribut']->evaluateExpression($seuils[$i]['blessAttribut']->getData('max'));
   
                if ($seuils[$i]['blessAttribut']->getFinalValue() < $max) {
                    $seuils[$i]['blessAttribut']->setValue($seuils[$i]['blessAttribut']->getFinalValue() + 1);
                    if (!$inconscience) {
                        $retour['blessures'][] = $seuils[$i]['code'] . ' (Physique)';
                        if ($seuils[$i]['code'] == 'GRAVE' || $seuils[$i]['code'] == 'CRITIQUE' || $seuils[$i]['code'] == 'FATALE') {
                            if ($this->type == '') {
                                $va = Attribut::getAttribut($this->id, $this->type . 'CHANCE');
                                $v = $va->getFinalValue();
                                $retour['jets'][] = 'Jet de chance (' . $v . '%). Si echec. hémorragie.';
                            } else {
                                $retour['jets'][] = 'Jet de chance (50%). Si echec. hémorragie.';
                            }
                        }
                    } else {
                        $retour['blessures'][] = $seuils[$i]['code'] . ' (Choc)';
                    }

                    $found = true;
                    break;
                }
            }
        }

        return $retour;
    }

    public function getNom() {
        $a = Attribut::getAttribut($this->id, $this->type . 'NOM');
        return $a->getFinalValue();
    }

}
