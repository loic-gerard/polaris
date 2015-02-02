<?php

namespace polarisapi\data\attribut;

use jin\query\Query;
use jin\query\QueryResult;
use jin\dataformat\Json;
use jin\lang\StringTools;
use jin\log\Debug;
use jin\cache\Cache;

class Attribut {

    protected $entiteId;
    private $attributName;
    protected $attributCode;
    protected $attributId;
    protected $value;
    protected $datas;
    protected $modifiable = false;

    public static function getAttribut($entiteId, $attributCode = null, $attributId = null) {
        $q = new Query();
        $q->setRequest('SELECT tt_type, tt_code FROM attribut');
        if ($attributCode) {
            $q->addToRequest('WHERE tt_code=' . $q->argument($attributCode, Query::$SQL_STRING));
        }
        if ($attributId) {
            $q->addToRequest('WHERE pk_attribut=' . $q->argument($attributId, Query::$SQL_NUMERIC));
        }
        $q->execute(true);
        $qr = $q->getQueryResults();
	
	if($qr->count() == 0){
	    throw new \Exception('Probleme attribut : '.$q->getSql());
	}

        $type = StringTools::firstCarToUpperCase($qr->getValueAt('tt_type'));
        $className = 'polarisapi\data\attribut\\' . $type;
        $c = new $className($entiteId, $qr->getValueAt('tt_code'), null);

        return $c;
    }

    public function __construct($entiteId, $attributCode, $value = null) {


        $this->entiteId = $entiteId;
        $this->attributCode = $attributCode;
        $this->value = $value;

        $q = new Query();
        $q->setRequest('SELECT * FROM attribut '
                . 'WHERE tt_code=' . $q->argument($attributCode, Query::$SQL_STRING));
        $q->execute(true);
        $qr = $q->getQueryResults();

        $this->attributName = $qr->getValueAt('tt_designation');
        $this->attributId = $qr->getValueAt('pk_attribut');
        $this->datas = Json::decode($qr->getValueAt('tt_data'));
        if ($qr->getValueAt('in_modifiable') == 1) {
            $this->modifiable = true;
        }

        if (is_null($this->value)) {

            if ($this->entiteId) {

                $q = new Query();
                $q->setRequest('SELECT * FROM valeur '
                        . 'WHERE fk_attribut=' . $q->argument($this->attributId, Query::$SQL_NUMERIC) . ' '
                        . 'AND fk_entite=' . $q->argument($this->entiteId, Query::$SQL_NUMERIC));
                $q->execute(true);
                $qr2 = $q->getQueryResults();

                if ($qr2->count() == 1) {
                    $this->value = Json::decode($qr2->getValueAt('tt_valeur'));
                    if (!$this->value) {
                        $this->value = $qr2->getValueAt('tt_valeur');
                    }
                } else {
                    $this->value = Json::decode($qr->getValueAt('tt_defaultvalue'));
                    if (!$this->value) {
                        $this->value = $qr->getValueAt('tt_defaultvalue');
                    }
                }
            } else {
                $this->value = Json::decode($qr->getValueAt('tt_defaultvalue'));
                if (!$this->value) {
                    $this->value = $qr->getValueAt('tt_defaultvalue');
                }
            }
        }
    }

    public function getModClass() {
        if ($this->isModifiable()) {
            return 'modifiable';
        }
        return '';
    }

    public function isModifiable() {
        return $this->modifiable;
    }

    public function getData($key) {
        return $this->datas[$key];
    }

    public function getAttributCode() {
        return $this->attributCode;
    }

    public function getAttributName() {
        return $this->attributName;
    }

    public function getValue($key = null) {
        return $this->value;
    }

    public function getFinalValue() {
        return $this->value;
    }

    public function renderForDisplay() {
        return $this->getValue();
    }

    public function renderForEdit() {
        return 'EDIT';
    }

    public function getModifier() {
        $q = new Query();
        $q->setRequest('SELECT SUM(fl_modificateur) AS modif '
                . 'FROM modificateur '
                . 'WHERE fk_entite=' . $q->argument($this->entiteId, Query::$SQL_NUMERIC) . ' '
                . 'AND fk_attribut=' . $q->argument($this->attributId, Query::$SQL_NUMERIC));
        $q->execute(true);
        $qr = $q->getQueryResults();
        $mod = $qr->getValueAt('modif');

        if (!is_numeric($mod)) {
            $mod = 0;
        }

        return $mod;
    }

    public function evaluateExpression($expression) {
        $pattern = "/{[^}]*}/";
        $search = StringTools::getMatches($expression, $pattern);


        foreach ($search AS $res) {
            if (StringTools::contains($res[0], 'SPE:') == true) {
                //Donnée interne "spe"
                $key = StringTools::replaceAll($res[0], '{SPE:', '');
                $key = StringTools::replaceAll($key, '}', '');

                if ($key == 'MODIFIER') {
                    $expression = StringTools::replaceAll($expression, $res[0], $this->getModifier());
                }
            } elseif (StringTools::contains($res[0], 'DATA:') == true) {
                //Donnée interne "data" à calculer
                $key = StringTools::replaceAll($res[0], '{DATA:', '');
                $key = StringTools::replaceAll($key, '}', '');
                $exp = $this->evaluateExpression($this->getData($key));
                $expression = StringTools::replaceAll($expression, $res[0], $exp);
            } elseif (StringTools::contains($res[0], 'VAL:') == true) {
                //Donnée interne
                $key = StringTools::replaceAll($res[0], '{VAL:', '');
                $key = StringTools::replaceAll($key, '}', '');
                $expression = StringTools::replaceAll($expression, $res[0], $this->getValue($key));
            } elseif (StringTools::contains($res[0], 'ATTR:') == true) {
                //Donnée externe
                $key = StringTools::replaceAll($res[0], '{ATTR:', '');
                $key = StringTools::replaceAll($key, '}', '');
                $attribut = Attribut::getAttribut($this->entiteId, $key, null);
                $expression = StringTools::replaceAll($expression, $res[0], $attribut->getFinalValue());
            }
        }

	try{
	    eval("\$resultat = $expression;");
	}catch(\Exception $e){
	    echo 'Pb avec expression : '.$expression;
	    exit;
	}
        return $resultat;
    }

    public function renderEditFormElement($key = null, $value) {
        $output = '';
        $output .= '<div class="editItem">';
        $output .= '<div class="label">' . $key . '</div>';
        if ($key) {
            
            $output .= '<div class="form"><input type="text" id="' . $this->attributCode . '_' . $this->entiteId . '_' . $key . '" name="' . $this->attributCode . '_' . $this->entiteId . '_' . $key . '" value="' . $value . '"></div>';
            $output .= '<script language="javascript">document.getElementById(\'' . $this->attributCode . '_' . $this->entiteId . '_' . $key . '\').focus();</script>';
        } else {
            $output .= '<div class="form"><input type="text" id="' . $this->attributCode . '_' . $this->entiteId . '" name="' . $this->attributCode . '_' . $this->entiteId . '" value="' . $value . '"></div>';
            $output .= '<script language="javascript">document.getElementById(\'' . $this->attributCode . '_' . $this->entiteId . '\').focus();</script>';
            
        }

        $output .= '</div>';

        return $output;
    }

    public function saveDataFromForm() {


        if (is_array($this->value)) {
            foreach ($this->value AS $k => $v) {
                $this->value[$k] = $_POST[$this->attributCode . '_' . $this->entiteId . '_' . $k];
            }
        } else {
            $this->value = $_POST[$this->attributCode . '_' . $this->entiteId];
        }

        $q = new Query();
        $q->setRequest('DELETE FROM valeur '
                . 'WHERE fk_attribut=' . $q->argument($this->attributId, Query::$SQL_NUMERIC) . ' '
                . 'AND fk_entite=' . $q->argument($this->entiteId, Query::$SQL_NUMERIC));
        $q->execute();

        if (is_array($this->value)) {
            $val = Json::encode($this->value);
        } else {
            $val = $this->value;
        }


        $q = new Query();
        $q->setRequest('INSERT INTO valeur '
                . '(fk_attribut, fk_entite, tt_valeur) '
                . 'VALUES '
                . '(' . $q->argument($this->attributId, Query::$SQL_NUMERIC) . ','
                . $q->argument($this->entiteId, Query::$SQL_NUMERIC) . ','
                . $q->argument($val, Query::$SQL_STRING) . ')');
        $q->execute();
	
	Cache::clearCache();
	
    }

    public function setValue($value, $key = null) {
        
        
        if ($key) {
            $this->value[$key] = $value;
        } else {
            $this->value = $value;
        }


        $q = new Query();
        $q->setRequest('DELETE FROM valeur '
                . 'WHERE fk_attribut=' . $q->argument($this->attributId, Query::$SQL_NUMERIC) . ' '
                . 'AND fk_entite=' . $q->argument($this->entiteId, Query::$SQL_NUMERIC));
        $q->execute();

        if (is_array($this->value)) {
            $val = Json::encode($this->value);
        } else {
            $val = $this->value;
        }


        $q = new Query();
        $q->setRequest('INSERT INTO valeur '
                . '(fk_attribut, fk_entite, tt_valeur) '
                . 'VALUES '
                . '(' . $q->argument($this->attributId, Query::$SQL_NUMERIC) . ','
                . $q->argument($this->entiteId, Query::$SQL_NUMERIC) . ','
                . $q->argument($val, Query::$SQL_STRING) . ')');
        $q->execute();
	
	Cache::clearCache();
    }

}
