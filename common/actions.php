<?php

use \PolarisCore;
use polarisapi\data\attribut\Attribut;
use jin\log\Debug;
use jin\filesystem\Folder;
use polarisapi\data\Entite;
use jin\dataformat\Json;

$folder = new Folder(ROOT.'appz/');
foreach ($folder AS $f){
    if(is_dir(ROOT.'appz/'.$f)){
       if(file_exists(ROOT.'appz/'.$f.'/actions.php')){
           include (ROOT.'appz/'.$f.'/actions.php');
       }
    }
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
    Entite::copyTo($_GET['addChoiceFrom'], $_GET['addChoiceTo'], $_GET['addChoiceId'], $_GET['addChoiceParent']);
    header('Location: '.PolarisCore::getUrl(array(), true, array('addChoiceFrom', 'addChoiceTo', 'addChoiceId', 'addChoiceParent')));
    
}
