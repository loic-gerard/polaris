<?php

use polarisapi\data\Entite;
use polarisapi\data\attribut\Attribut;

if($_POST['talent'] != ''){
    $a = Attribut::getAttribut($_POST['joueur'], $_POST['talent']);
    $name = $a->getAttributName();
    
    $data = array();
    $data['EVOLUTION_DESIGNATION'] = 'Evolution talent '.$name;
    $data['EVOLUTION_TALENT'] = $_POST['talent'];
    $data['EVOLUTION_TYPE'] = 'TALENT';
    
    Entite::addEntite('EVOLUTION', $data, $_POST['joueur']);
}else{
    $data = array();
    if($_POST['type'] == 'IDEE'){
	$data['EVOLUTION_DESIGNATION'] = 'Belle idée !';
    }else if($_POST['type'] == 'ACTION'){
	$data['EVOLUTION_DESIGNATION'] = 'Belle action !';
    }else if($_POST['type'] == 'INTERPRETATION'){
	$data['EVOLUTION_DESIGNATION'] = 'Belle interprétation !';
    }else if($_POST['type'] == 'AVENTURE'){
	$data['EVOLUTION_DESIGNATION'] = 'Chapitre d\'aventure débloqué';
    }else{
	return;
    }
    
    $data['EVOLUTION_TALENT'] = '';
    $data['EVOLUTION_TYPE'] = $_POST['type'];
    Entite::addEntite('EVOLUTION', $data, $_POST['joueur']);
}
