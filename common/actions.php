<?php

use \PolarisCore;
use polarisapi\data\attribut\Attribut;
use jin\log\Debug;
use jin\filesystem\Folder;
use polarisapi\data\Entite;
use jin\dataformat\Json;
use polarisapi\data\View;


$folder = new Folder(ROOT.'appz/');
foreach ($folder AS $f){
    if(is_dir(ROOT.'appz/'.$f)){
       if(file_exists(ROOT.'appz/'.$f.'/actions.php')){
           include (ROOT.'appz/'.$f.'/actions.php');
       }
    }
}

//Fin d'aventure'
if (isset($_GET['progression'])) {
       $joueurs = new View('PJ', 'v_NOM.tt_valeur', 'ASC', '', array('NOM'));
       
       foreach ($joueurs AS $joueur) {

	   $total = 0;
	   $points = new View('EVOLUTION', null, null, '', array('EVOLUTION_TALENT', 'EVOLUTION_TYPE', 'EVOLUTION_DESIGNATION'), $joueur['id']);
	   foreach ($points AS $p) {
	       if ($p['EVOLUTION_TYPE'] == 'TALENT') {
	       } else {
		   $total += 0.25;
	       }
	       
	       Entite::deleteEntite($p['id']);
	   }

	   $a = Attribut::getAttribut($joueur['id'], 'EVOLUTION');
	   $av = $a->getFinalValue();
	   $av += $total;
	   $a->setValue($av);
       }
       
       header('Location: '.PolarisCore::getUrl(array(), true, array('progression')));
}

//Equiper
if(isset($_GET['equiper'])){
    $attribut = Attribut::getAttribut($_GET['equiper'], $_GET['equiperAttribut']);
    $attribut->setValue('1');
    header('Location: '.PolarisCore::getUrl(array(), true, array('equiper', 'equiperAttribut')));
}

//DesEquiper
if(isset($_GET['desequiper'])){
    $attribut = Attribut::getAttribut($_GET['desequiper'], $_GET['equiperAttribut']);
    $attribut->setValue('0');
    header('Location: '.PolarisCore::getUrl(array(), true, array('desequiper', 'equiperAttribut')));
}

if (isset($_GET['modAttr']) && isset($_GET['modId']) && isset($_POST['attributModifierFormValid'])) {
    $attribut = Attribut::getAttribut($_GET['modId'], $_GET['modAttr']);
    $attribut->saveDataFromForm();
    header('Location: '.PolarisCore::getUrl(array(), true, array('modAttr', 'modId')));
    
}

if(isset($_GET['addEntite']) && isset($_POST['entiteAddFormValid'])){
    $toEdit = Json::decode($_GET['toEdit']);
    $toSet = Json::decode($_GET['toSet']);
    $parent = $_GET['parent'];
    $entiteType = $_GET['addEntite'];
    
    if($parent == 0){
        $parent = null;
    }
    
    
    $data = array();
    foreach ($toEdit AS $c){
        $data[$c] = $_POST[$c.'_'];
    }
    foreach($toSet AS $c => $v){
        $data[$c] = $_POST[$c.'_'];
    }
    
    Entite::addEntite($entiteType, $data, $parent);
    
    header('Location: '.PolarisCore::getUrl(array(), true, array('addEntite', 'toEdit', 'toSet', 'parent')));
}

if(isset($_GET['entiteDelete'])){
    Entite::deleteEntite($_GET['entiteDelete']);
    header('Location: '.PolarisCore::getUrl(array(), true, array('entiteDelete')));
}

if(isset($_GET['addChoiceId'])){
    $parent = null;
    if(isset($_GET['addChoiceParent'])){
	$parent = $_GET['addChoiceParent'];
    }
    Entite::copyTo($_GET['addChoiceFrom'], $_GET['addChoiceTo'], $_GET['addChoiceId'], $parent);
    header('Location: '.PolarisCore::getUrl(array(), true, array('addChoiceFrom', 'addChoiceTo', 'addChoiceId', 'addChoiceParent')));
    
}
