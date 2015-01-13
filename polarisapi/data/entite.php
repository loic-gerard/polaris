<?php

namespace polarisapi\data;

use jin\query\Query;
use jin\query\QueryResult;
use jin\db\DbConnexion;
use jin\lang\StringTools;

class Entite{
    
    public static function copyTo($entiteCodeFrom, $entiteCodeTo, $entiteFromId, $parent = null){
        $q = new Query();
        $q->setRequest('SELECT * FROM entitetype WHERE tt_code='.$q->argument($entiteCodeFrom, Query::$SQL_STRING));
        $q->execute();
        $qrfrom = $q->getQueryResults();
        
        $q = new Query();
        $q->setRequest('SELECT * FROM entitetype WHERE tt_code='.$q->argument($entiteCodeTo, Query::$SQL_STRING));
        $q->execute();
        $qrto = $q->getQueryResults();

        $q = new Query();
        $q->setRequest('SELECT a.tt_code, v.*'
                . 'FROM attribut AS a '
                . 'JOIN valeur AS v ON v.fk_attribut = a.pk_attribut '
                . 'WHERE a.fk_entitetype='.$q->argument($qrfrom->getValueAt('pk_entitetype'), Query::$SQL_NUMERIC).' '
                . 'AND v.fk_entite='.$q->argument($entiteFromId, Query::$SQL_NUMERIC));
        $q->execute();
        $qr = $q->getQueryResults();
        
        $q = new Query();
        $q->setRequest('INSERT INTO entite '
                . '(fk_entitetype');
	if($parent){
	    $q->addToRequest(',fk_entite');
	}
	$q->addToRequest(')VALUES'
                . '('.$q->argument($qrto->getValueAt('pk_entitetype'), Query::$SQL_NUMERIC));
	if($parent){
	    $q->addToRequest(','.$q->argument($parent, Query::$SQL_NUMERIC));
	}
	$q->addToRequest(')');

        $q->execute();
        $id = DbConnexion::getLastInsertId('entite', 'pk_entite');
        
        foreach($qr AS $r){
            $code = StringTools::replaceFirst($r['tt_code'], 'REF_', '');
            
            $q =  new Query();
            $q->setRequest('SELECT * FROM attribut '
                    . 'WHERE fk_entitetype='.$q->argument($qrto->getValueAt('pk_entitetype'), Query::$SQL_NUMERIC).' '
                    . 'AND tt_code='.$q->argument($code, Query::$SQL_STRING));
            $q->execute();
            $qra = $q->getQueryResults();
	    
	    if($qra->count() == 0){
		throw new \Exception('Probleme attribut : '.$q->getSql());
	    }
            
            $q = new Query();
            $q->setRequest('INSERT INTO valeur '
                    . '(fk_attribut,'
                    . 'tt_valeur,'
                    . 'fk_entite)'
                    . 'VALUES'
                    . '('.$q->argument($qra->getValueAt('pk_attribut'), Query::$SQL_NUMERIC).','
                    . $q->argument($r['tt_valeur'], Query::$SQL_STRING).','
                    . $q->argument($id, Query::$SQL_NUMERIC).')');
            $q->execute();
            
        }
        
    }
    
    public static function deleteEntite($entiteId){
        $q = new Query();
        $q->setRequest('DELETE FROM valeur WHERE fk_entite='.$q->argument($entiteId, Query::$SQL_NUMERIC));
        $q->execute();
        
        $q = new Query();
        $q->setRequest('DELETE FROM entite WHERE fk_entite='.$q->argument($entiteId, Query::$SQL_NUMERIC));
        $q->execute();
        
        $q = new Query();
        $q->setRequest('DELETE FROM entite WHERE pk_entite='.$q->argument($entiteId, Query::$SQL_NUMERIC));
        $q->execute();
    }
    
    public static function addEntite($entityType, $data, $parentEntite = null){
        
        DbConnexion::beginTransaction();
        //get Entity type
        $q = new Query();
        $q->setRequest('SELECT * FROM entitetype WHERE tt_code='.$q->argument($entityType, Query::$SQL_STRING));
        $q->execute();
        $qr = $q->getQueryResults();
        
        //Add entite
        $q = new Query();
        $q->addToRequest('INSERT INTO entite '
                . '(fk_entitetype');
        if($parentEntite){
            $q->addToRequest(',fk_entite');
        }
        $q->addToRequest(')'
                . 'VALUES'
                . '('.$q->argument($qr->getValueAt('pk_entitetype'), Query::$SQL_NUMERIC));
        if($parentEntite){
            $q->addToRequest(','.$q->argument($parentEntite, Query::$SQL_NUMERIC));
        }
        $q->addToRequest(')');
        $q->execute();
        
        $id = DbConnexion::getLastInsertId('entite', 'pk_entite');
        
        foreach($data AS $key => $v){
            //Get attribut
            $q = new Query();
            $q->setRequest('SELECT * FROM attribut WHERE tt_code='.$q->argument($key, Query::$SQL_STRING));
            $q->execute();
            $qr = $q->getQueryResults();
            
            //Insert
            $q = new Query();
            $q->setRequest('INSERT INTO valeur '
                    . '(fk_attribut, '
                    . 'tt_valeur, '
                    . 'fk_entite) '
                    . 'VALUES '
                    . '('.$q->argument($qr->getValueAt('pk_attribut'), Query::$SQL_NUMERIC).','
                    . ''.$q->argument($v, Query::$SQL_STRING).','
                    . ''.$q->argument($id, Query::$SQL_NUMERIC).')');
            $q->execute();
        }
        
        DbConnexion::commitTransaction();
    }
}