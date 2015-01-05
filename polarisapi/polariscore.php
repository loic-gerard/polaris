<?php

class PolarisCore{
    public static function autoload($className) {
	$tab = explode('\\', $className);
	$path = strtolower(implode(DIRECTORY_SEPARATOR, $tab)) . '.php';
	
	if(is_file($path)){
	    require($path);
	}
    }
}

