<?php

namespace polarisapi\data;

use jin\query\Query;
use jin\query\QueryResult;
use jin\lang\StringTools;
use jin\log\Debug;

class View{
    private $datas = array();
    
    public function __construct($entiteType, $orderBy, $orderBySens = 'ASC', $condition = '', $attributs = array()) {
        $q = new Query();
        $q->setRequest('SELECT e.pk_entite ');
        foreach($attributs AS $attribut){
            $q->addToRequest(',v_'.$attribut.'.tt_valeur AS val_'.$attribut);
            $q->addToRequest(',a_'.$attribut.'.tt_type AS type_'.$attribut);
        }
        $q->addToRequest('FROM entite AS e '
                . 'JOIN entitetype AS et ON et.pk_entitetype = e.fk_entitetype AND et.tt_code='.$q->argument($entiteType, Query::$SQL_STRING));
        foreach($attributs AS $attribut){
            $q->addToRequest('LEFT JOIN attribut AS a_'.$attribut.' ON a_'.$attribut.'.tt_code='.$q->argument($attribut, Query::$SQL_STRING).' '
                . 'LEFT JOIN valeur AS v_'.$attribut.' ON v_'.$attribut.'.fk_entite = e.pk_entite AND a_'.$attribut.'.pk_attribut = v_'.$attribut.'.fk_attribut ');
        }
        $q->execute();
        $qr = $q->getQueryResults();
        
        Debug::dump($qr);
        
        foreach($qr AS $r){
            $l = array();
            $l['id'] = $r['pk_entite'];
            
            foreach ($attributs AS $attribut){
                $type = StringTools::firstCarToUpperCase($r['type_'.$attribut]);
                $className = 'polarisapi\data\attribut\\' . $type;
		$c = new $className($r['pk_entite'], $attribut);
                $l[$attribut] = $c->getFinalValue();
            }
            
            $this->datas[] = $l;
        }
    }
    
    public function getDatas(){
        return $this->datas;
    }
}