<?php

use jin\JinCore;
use jin\log\Debug;
use jin\lang\ArrayTools;
use jin\dataformat\Json;

class PolarisCore{
    public static function autoload($className) {
	$tab = explode('\\', $className);
	$path = strtolower(implode(DIRECTORY_SEPARATOR, $tab)) . '.php';
	
	if(is_file($path)){
	    require($path);
	}
    }
    
    public static function getUrl($toParse = array(), $keepExistant = true, $except = array()){
        $baseUrl = JinCore::getContainerUrl();
        $args = array();
        if($keepExistant){
            $args = $_GET;
            foreach($except as $k){
                if(isset($args[$k])){
                    unset($args[$k]);
                }
            }
        }
        foreach($toParse AS $k => $v){
            $args[$k] = $v;
        }
        $baseUrl .= '?'.http_build_query($args);
        return $baseUrl;
    }
    
    public static function getFromUrl($key, $default = ''){
        if(isset($_GET[$key])){
            return $_GET[$key];
        }
        return $default;
    }
    
    public static function getModifierUrl($id_entite, $attributCode, $js = false){
        if($js){
            return ' onclick="javascript:document.location=\''.PolarisCore::getUrl(array('modId' => $id_entite, 'modAttr' => $attributCode), true, array('modId', 'modAttr')).'\';" ';
        }else{
            return PolarisCore::getUrl(array('modId' => $id_entite, 'modAttr' => $attributCode), true, array('modId', 'modAttr'));
        }
    }
    
    public static function getAddUrl($entiteType, $attributsToEdit = array(), $attributsToSet = array(), $parent = 0){
        $toEdit = Json::encode($attributsToEdit);
        $toSet = Json::encode($attributsToSet);
        $addUrl = PolarisCore::getUrl(array('addEntite' => $entiteType, 'toEdit' => $toEdit, 'toSet' => $toSet, 'parent' => $parent), true, array());
    
        return $addUrl;
    }
    
    public static function getDeleteUrl($entiteId){
        return self::getUrl(array('entiteDelete' => $entiteId), true, array());
    }
}

