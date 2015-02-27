<?php

namespace polarisapi;

use jin\dataformat\Json;
use jin\filesystem\File;
use jin\log\Debug;
use jin\db\DbConnexion;
use jin\query\Query;
use jin\query\QueryResult;

class Initializer{
    public static $update;
    
    public static function initialize($update = false){
        self::$update = $update;
        
        //On lit les données
        $json = self::readConfigFile();
        
        //Debut du Traitement
        DbConnexion::beginTransaction();
        
        //On vide la base de données
       
        self::emptyDatabase();
        
        
        foreach($json as $entiteTypeCode => $entiteTypeValue){
            self::treatEntiteType($entiteTypeCode, $entiteTypeValue);
        }
	
	//Traitement de l'encylopédie
	self::readEncyclopedia();
        
        //Traitement des paliers
        self::importPaliers();
        
        //Fin du traitement
        DbConnexion::commitTransaction();
        
        self::log('Fin du traitement');
    }
    
    private static function readConfigFile(){
        $f = new File(ROOT.'config/config.json');
        $json = Json::decode($f->getContent());
        
        self::log('Lecture du fichier de configuration');
        return $json;
    }
    
    private static function readEncyclopedia(){
	self::log('Chargement de l\'encyclopédie');
	$f = new File(ROOT.'config/encyclopedia.json');
        $json = Json::decode($f->getContent());
	
	foreach($json as $entiteTypeCode => $entiteTypeValue){
            self::treatEntiteType($entiteTypeCode, $entiteTypeValue);
        }
    }
    
    private static function emptyDatabase(){
        //Clear
        $q = new Query();
        if(!self::$update){
            
            $q->setRequest('DELETE FROM attribut');
            $q->execute();
            $q = new Query();
            $q->setRequest('DELETE FROM categorie');
            $q->execute();
            $q = new Query();
            $q->setRequest('DELETE FROM entite');
            $q->execute();
            $q = new Query();
            $q->setRequest('DELETE FROM entitetype');
            $q->execute();
            $q = new Query();
            $q->setRequest('DELETE FROM modificateur');
            $q->execute();
            $q = new Query();
            $q->setRequest('DELETE FROM valeur');
            $q->execute();
            $q->setRequest('DELETE FROM palier');
            $q->execute();
        }else{
            $q->setRequest('DELETE FROM palier');
            $q->execute();
        }

        self::log('Supression des données en Base de données');
    }
    
    private static function treatEntiteType($code, $data){
        self::log('---Traitement de l\'entitéType '.$code);
        
        if(self::$update){
            $q = new Query();
            $q->setRequest('SELECT * FROM entitetype WHERE tt_code='.$q->argument($code, Query::$SQL_STRING));
            $q->execute();
            $qr = $q->getQueryResults();
        }
        
        
        if(self::$update && $qr->count() == 1){
            //MAJ de l'entitéType
            $q = new Query();
            $q->setRequest('UPDATE entitetype '
                    . 'SET tt_designation='.$q->argument($data['designation'], Query::$SQL_STRING).' '
                    . 'WHERE pk_entitetype='.$q->argument($qr->getValueAt('pk_entitetype', 0), Query::$SQL_NUMERIC));
            $q->execute();
            $id_entiteType = $qr->getValueAt('pk_entitetype', 0);
        }else{
            //Ajout de l'entitéType
            $q = new Query();
            $q->setRequest('INSERT INTO entitetype '
                    . '(tt_code, tt_designation)'
                    . 'VALUES'
                    . '('.$q->argument($code, Query::$SQL_STRING).','
                    . $q->argument($data['designation'], Query::$SQL_STRING).')');
            $q->execute();
            $id_entiteType = DbConnexion::getLastInsertId('entitetype', 'pk_entitetype');
        }
        
        
        
        //Ajout/MAJ des categories
        if(isset($data['categories'])){
            foreach($data['categories'] AS $categorieCode => $categorieData){
                $id_categorie = self::treatCategorie($categorieCode, $id_entiteType, $categorieData);
                
                //Ajout des attributs
                foreach($categorieData['attributs'] AS $attributCode => $attributData){
                    $id_attribut = self::treatAttribut($attributCode, $attributData, $id_entiteType, $id_categorie);
                }
            }
        }
        
        //Ajout des attributs non attachés à des catégories
        if(isset($data['attributs'])){
            foreach($data['attributs'] AS $attributCode => $attributData){
                $id_attribut = self::treatAttribut($attributCode, $attributData, $id_entiteType);
            }
        }
        
        //Ajout des entités
        if(!self::$update){
            if(isset($data['entites'])){
                foreach($data['entites'] AS $entiteData){
                    $id_entite = self::treatEntite($id_entiteType, $entiteData);
                }
            }
        }
        
    }
    
    private static function treatCategorie($code, $id_entiteType, $data){
        self::log('------Traitement de la catégorie '.$code);
        
        if(self::$update){
            $q = new Query();
            $q->setRequest('SELECT * FROM categorie WHERE tt_code='.$q->argument($code, Query::$SQL_STRING));
            $q->execute();
            $qr = $q->getQueryResults();
        }
        
        if(self::$update && $qr->count()==1){
            $q = new Query();
            $q->setRequest('UPDATE categorie '
                    . 'SET tt_designation='.$q->argument($data['designation'], Query::$SQL_STRING).' '
                    . ',fk_entitetype='.$q->argument($id_entiteType, Query::$SQL_NUMERIC).' '
                    . 'WHERE tt_code='.$q->argument($code, Query::$SQL_STRING));
            $q->execute();
            $id = $qr->getValueAt('pk_categorie');
        }else{
            //Ajout catégorie
            $q = new Query();
            $q->setRequest('INSERT INTO categorie '
                    . '(tt_code,'
                    . 'tt_designation,'
                    . 'fk_entitetype)'
                    . 'VALUES'
                    . '('.$q->argument($code, Query::$SQL_STRING).','
                    . $q->argument($data['designation'], Query::$SQL_STRING).','
                    . $q->argument($id_entiteType, Query::$SQL_NUMERIC).')');
            $q->execute();
            $id = DbConnexion::getLastInsertId('categorie', 'pk_categorie');
        }
        
        return $id;
    }
    
    private static function treatAttribut($code, $data, $id_entiteType, $id_categorie = 0){
        if($id_categorie > 0){
            self::log('---------Traitement l\'attribut '.$code);
        }else{
            self::log('------Traitement l\'attribut '.$code);
        }
        
        
        $insData = "{}";
        if(isset($data['data'])){
            $insData = Json::encode($data['data']);
        }
        
        $defValue = "";
        if(isset($data['defaultValue'])){
            if(is_array($data['defaultValue'])){
                $defValue = Json::encode($data['defaultValue']);
            }else{
                $defValue = $data['defaultValue'];
            }
        }
        
        $modifiable = 1;
        if(isset($data['modifiable'])){
            $modifiable = $data['modifiable'];
        }
        
        $modificateur = 0;
        if(isset($data['modificateur'])){
            $modificateur = $data['modificateur'];
        }
        
        $jet = 1;
        if(isset($data['jet'])){
            $jet = $data['jet'];
        }
        
        
        if(self::$update){
            $q = new Query();
            $q->setRequest('SELECT * FROM attribut WHERE tt_code='.$q->argument($code, Query::$SQL_STRING));
            $q->execute();
            $qr = $q->getQueryResults();
        }
        
        if(self::$update && $qr->count()==1){
            $q = new Query();
            $q->setRequest('UPDATE attribut '
                    . 'SET tt_designation='.$q->argument($data['designation'], Query::$SQL_STRING).','
                    . 'fk_entitetype='.$q->argument($id_entiteType, Query::$SQL_NUMERIC).','
                    . 'fk_categorie='.$q->argument($id_categorie, Query::$SQL_NUMERIC).','
                    . 'tt_type='.$q->argument($data['type'], Query::$SQL_STRING).','
                    . 'tt_data='.$q->argument($insData, Query::$SQL_STRING).','
                    . 'tt_defaultvalue='.$q->argument($defValue, Query::$SQL_STRING).','
                    . 'in_modifiable='.$q->argument($modifiable, Query::$SQL_NUMERIC).','
                    . 'in_modificateur='.$q->argument($modificateur, Query::$SQL_NUMERIC).','
                    . 'in_jet='.$q->argument($jet, Query::$SQL_NUMERIC).' '
                    . 'WHERE tt_code='.$q->argument($code, Query::$SQL_STRING));
            $q->execute();
            $id = $qr->getValueAt('pk_attribut');
        }else{
            //Ajout attribut
            $q = new Query();
            $q->setRequest('INSERT INTO attribut '
                    . '(tt_code,'
                    . 'tt_designation,'
                    . 'fk_entitetype,'
                    . 'fk_categorie,'
                    . 'tt_type,'
                    . 'tt_data,'
                    . 'tt_defaultvalue,'
                    . 'in_modifiable,'
                    . 'in_modificateur,'
                    . 'in_jet)'
                    . 'VALUES'
                    . '('.$q->argument($code, Query::$SQL_STRING).','
                    . $q->argument($data['designation'], Query::$SQL_STRING).','
                    . $q->argument($id_entiteType, Query::$SQL_NUMERIC).','
                    . $q->argument($id_categorie, Query::$SQL_NUMERIC).','
                    . $q->argument($data['type'], Query::$SQL_STRING).','
                    . $q->argument($insData, Query::$SQL_STRING).','
                    . $q->argument($defValue, Query::$SQL_STRING).','
                    . $q->argument($modifiable, Query::$SQL_NUMERIC).','
                    . $q->argument($modificateur, Query::$SQL_NUMERIC).','
                    . $q->argument($jet, Query::$SQL_NUMERIC).')');
            $q->execute();
            $id = DbConnexion::getLastInsertId('attribut', 'pk_attribut');
        }
        
        
        return $id;
    }
    
    private static function treatEntite($id_entiteType, $data){
        self::log('------Ajout d\une entité');
        
        
        //Ajout
        $q = new Query();
        $q->setRequest('INSERT INTO entite '
                . '(fk_entitetype)'
                . 'VALUES'
                . '('.$q->argument($id_entiteType, Query::$SQL_NUMERIC).')');
        $q->execute();
        $id_entite = DbConnexion::getLastInsertId('entite', 'pk_entite');
        
        //On ajoute les valeurs
        foreach($data AS $itemCode => $itemValue){
            self::treatValue($id_entite, $id_entiteType, $itemCode, $itemValue);
        }
        
        return $id_entite;
    }
    
    private static function treatValue($id_entite, $id_entiteType, $code, $valeur){
        if(is_array($valeur)){
            $valeur = Json::encode($valeur);
        }
        
        $q = new Query();
        $q->setRequest('SELECT pk_attribut '
                . 'FROM attribut '
                . 'WHERE tt_code='.$q->argument($code, Query::$SQL_STRING).' '
                . 'AND fk_entitetype='.$q->argument($id_entiteType, Query::$SQL_NUMERIC));
        $q->execute();
        $qr = $q->getQueryResults();
        
        $q = new Query();
        $q->setRequest('INSERT INTO valeur '
                . '(fk_attribut,'
                . 'tt_valeur,'
                . 'fk_entite)'
                . 'VALUES'
                . '('.$q->argument($qr->getValueAt('pk_attribut'), Query::$SQL_NUMERIC).','
                . $q->argument($valeur, Query::$SQL_STRING).','
                . $q->argument($id_entite, Query::$SQL_NUMERIC).')');
        $q->execute();
    }
    
    private static function log($log){
        echo $log.'<br>';
    }
    
    private static function importPaliers(){
        self::log('IMPORT DES PALIERS');
        
        $f = new File(ROOT.'config/paliers.json');
        $json = Json::decode($f->getContent());
        
        foreach($json AS $palier => $palierValues){
            foreach($palierValues AS $marge => $margeValues){
                $q = new Query();
                $q->setRequest('INSERT INTO palier '
                        . '(min,'
                        . 'max,'
                        . 'marge,'
                        . 'palier)'
                        . 'VALUES'
                        . '('.$q->argument($margeValues['min'], Query::$SQL_NUMERIC).','
                        . $q->argument($margeValues['max'], Query::$SQL_NUMERIC).','
                        . $q->argument($marge, Query::$SQL_NUMERIC).','
                        . $q->argument($palier, Query::$SQL_NUMERIC).')');
                $q->execute();
                
            }
        }
    }
}