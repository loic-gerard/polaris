<?php
use \PolarisCore;
use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\data\attribut\Attribut;
use polarisapi\objects\Player;
use polarisapi\objects\Pnj;
use polarisapi\data\Entite;
use jin\lang\ArrayTools;

$confirm = false;

//Fatigue +
if(isset($_POST['valid']) && $_GET['actpane'] == 'fatigueadd/actpane.php'){
    $player = new Player($_POST['joueur']);
    $player->addFatigue();
    
    header('Location: '.PolarisCore::getUrl(array(), true, array('actpane')));
}

//Fatigue -
if(isset($_POST['valid']) && $_GET['actpane'] == 'fatigueremove/actpane.php'){
    $player = new Player($_POST['joueur']);
    $player->removeFatigue();
    
    header('Location: '.PolarisCore::getUrl(array(), true, array('actpane')));
}

//Combat à distance : Etape 1
if(isset($_POST['valid']) && $_GET['actpane'] == 'combat_distance/actpane.php'){
    $typeAttaquant = $_POST['typeAttaquant'];
    if($_POST['typeAttaquant'] == 'PJ'){
	$idAttaquant = $_POST['joueurAttaquant'];
    }else{
	$idAttaquant = $_POST['pnjAttaquant'];
    }
    
    $typeDefenseur = $_POST['typeDefenseur'];
    if($_POST['typeDefenseur'] == 'PJ'){
	$idDefenseur = $_POST['joueurDefenseur'];
    }else{
	$idDefenseur = $_POST['pnjDefenseur'];
    }
    
    $modificateurs1 = '';
    if(isset($_POST['modificateurs1'])){
	$modificateurs1 = ArrayTools::toList($_POST['modificateurs1']);
    }
    
    $modificateurs2 = '';
    if(isset($_POST['modificateurs2'])){
	$modificateurs2 = ArrayTools::toList($_POST['modificateurs2']);
    }
    
    
    header('Location: '.PolarisCore::getUrl(array('actpane' => 'combat_distance/actpane2.php', 'idAttaquant' => $idAttaquant, 'typeAttaquant' => $typeAttaquant, 'idDefenseur' => $idDefenseur, 'typeDefenseur' => $typeDefenseur, 'modificateurs1' => $modificateurs1, 'modificateurs2' => $modificateurs2), true, array('actpane')));
}

//Combat à distance : Etape 2
if(isset($_POST['valid']) && $_GET['actpane'] == 'combat_distance/actpane2.php'){
    
    
    $parer = 0;
    $parerRes = 0;
    $parerMarge = 0;
    $esquiver = 0;
    $esquiverMarge = 0;
    $portee = $_POST['portee'];
    
    if($_POST['parer'] == 1){
	$parer = 1;
	$parerRes = $_POST['parer_objet'];
	$parerMarge = $_POST['margeParer'];
    }
    
    if($_POST['esquiver'] == 1){
	$esquiver = 1;
	$esquiverMarge = $_POST['margeEsquiver'];
    }
    
    header('Location: '.PolarisCore::getUrl(array('actpane' => 'combat_distance/actpane3.php', 'portee' => $portee, 'parer' => $parer, 'parerRes' => $parerRes, 'parerMarge' => $parerMarge, 'esquiver' => $esquiver, 'esquiverMarge' => $esquiverMarge), true, array('actpane')));
}

//Combat à distance : Etape 3
if(isset($_POST['valid']) && $_GET['actpane'] == 'combat_distance/actpane3.php'){
    $reussiteCritique = $_POST['reussiteCritique'];
    if($reussiteCritique > 0){
        $margeReussite = $reussiteCritique;
    }else{
        $margeReussite = $_POST['marge'];
    }
    
    header('Location: '.PolarisCore::getUrl(array('actpane' => 'combat_distance/actpane4.php', 'reussiteCritique' => $reussiteCritique, 'margeReussite' => $margeReussite), true, array('actpane')));
}



//Combat au corps à corps : Etape 1
if(isset($_POST['valid']) && $_GET['actpane'] == 'combat_corpsacorps/actpane.php'){
    $typeAttaquant = $_POST['typeAttaquant'];
    if($_POST['typeAttaquant'] == 'PJ'){
	$idAttaquant = $_POST['joueurAttaquant'];
    }else{
	$idAttaquant = $_POST['pnjAttaquant'];
    }
    
    $typeDefenseur = $_POST['typeDefenseur'];
    if($_POST['typeDefenseur'] == 'PJ'){
	$idDefenseur = $_POST['joueurDefenseur'];
    }else{
	$idDefenseur = $_POST['pnjDefenseur'];
    }
    
    $modificateurs1 = '';
    if(isset($_POST['modificateurs1'])){
	$modificateurs1 = ArrayTools::toList($_POST['modificateurs1']);
    }
    
    $modificateurs2 = '';
    if(isset($_POST['modificateurs2'])){
	$modificateurs2 = ArrayTools::toList($_POST['modificateurs2']);
    }
    
    header('Location: '.PolarisCore::getUrl(array('actpane' => 'combat_corpsacorps/actpane2.php', 'idAttaquant' => $idAttaquant, 'typeAttaquant' => $typeAttaquant, 'idDefenseur' => $idDefenseur, 'typeDefenseur' => $typeDefenseur, 'modificateurs1' => $modificateurs1, 'modificateurs2' => $modificateurs2), true, array('actpane')));
}

//Combat corps a corps : Etape 2
if(isset($_POST['valid']) && $_GET['actpane'] == 'combat_corpsacorps/actpane2.php'){
    
    
    $parer = "0";
    $parerRes = "0";
    $parerMarge = "0";
    $esquiver = "0";
    $esquiverMarge = 0;

    
    if($_POST['parer'] == 1){
	$parer = "1";
	$parerRes = $_POST['parer_objet'];
	$parerMarge = $_POST['margeParer'];
    }
    
    if($_POST['esquiver'] == "1"){
	$esquiver = "1";
	$esquiverMarge = $_POST['margeEsquiver'];
    }

    
    header('Location: '.PolarisCore::getUrl(array('actpane' => 'combat_corpsacorps/actpane3.php', 'parer' => $parer, 'parerRes' => $parerRes, 'parerMarge' => $parerMarge, 'esquiver' => $esquiver, 'esquiverMarge' => $esquiverMarge), true, array('actpane')));
}

//Combat corps a corps : Etape 3
if(isset($_POST['valid']) && $_GET['actpane'] == 'combat_corpsacorps/actpane3.php'){
    $reussiteCritique = $_POST['reussiteCritique'];
    if($reussiteCritique > 0){
        $margeReussite = $reussiteCritique;
    }else{
        $margeReussite = $_POST['marge'];
    }
    
    header('Location: '.PolarisCore::getUrl(array('actpane' => 'combat_corpsacorps/actpane4.php', 'reussiteCritique' => $reussiteCritique, 'margeReussite' => $margeReussite), true, array('actpane')));
}


//Ajout blessure
if(isset($_POST['valid']) && $_GET['actpane'] == 'blessure/actpane.php'){
    if($_POST['target'] == 'PJ'){
	$player = new Player($_POST['joueur']);
	$choc = 0;
	if($_POST['blessure_choc'] > 0){
	    $choc = $_POST['blessure_choc'];
	}
	$physique = 0;
	if($_POST['blessure_physique'] > 0){
	    $physique = $_POST['blessure_physique'];
	}
	$resultat = $player->addBlessure($physique, $choc);
    }else{
	$player = new Pnj($_POST['pnj']);
	$choc = 0;
	if($_POST['blessure_choc'] > 0){
	    $choc = $_POST['blessure_choc'];
	}
	$physique = 0;
	if($_POST['blessure_physique'] > 0){
	    $physique = $_POST['blessure_physique'];
	}
	$resultat = $player->addBlessure($physique, $choc);
    }

    $confirm = true;
}

//Ajout hemorragie PJ / PNJ
if(isset($_POST['valid']) && $_GET['actpane'] == 'addhemorragie/actpane.php'){
    if($_POST['target'] == 'PJ'){
	$id = $_POST['joueur'];
    }else{
	$id = $_POST['pnj'];
    }
    Entite::addEntite('HEMORRAGIE', array('HEMORRAGIE_TYPE' => $_POST['typeHemorragie']), $id);
    header('Location: '.PolarisCore::getUrl(array(),true, array('actpane')));
}

//Tomber inconscient
if(isset($_POST['valid']) && $_GET['actpane'] == 'inconscientoui/actpane.php'){
    if($_POST['target'] == 'PJ'){
	$id = $_POST['joueur'];
	$type = '';
    }else{
	$id = $_POST['pnj'];
	$type = 'PNJ_';
    }
    $inconscient = Attribut::getAttribut($id, $type.'INCONSCIENT');
    $inconscient->setValue('1');
    header('Location: '.PolarisCore::getUrl(array(),true, array('actpane')));
}

//Sortir de l'inconscience
if(isset($_POST['valid']) && $_GET['actpane'] == 'inconscientnon/actpane.php'){
    if($_POST['target'] == 'PJ'){
	$id = $_POST['joueur'];
	$type = '';
    }else{
	$id = $_POST['pnj'];
	$type = 'PNJ_';
    }
    $inconscient = Attribut::getAttribut($id, $type.'INCONSCIENT');
    $inconscient->setValue('0');
    header('Location: '.PolarisCore::getUrl(array(),true, array('actpane')));
}

//Suppression PNJ
if(isset($_GET['deletePnj'])){
    Entite::deleteEntite($_GET['deletePnj']);
    header('Location: '.PolarisCore::getUrl(array(),true, array('deletePnj')));
}

//Ajout journal
if(isset($_POST['valid']) && $_GET['actpane'] == 'aventure/actpane.php'){
    $data = array();
    $data['JOURNAL_TEXTE'] = $_POST['journal'];
    $data['JOURNAL_DATE'] = $_POST['date'];
    Entite::addEntite('JOURNAL', $data);
    
    header('Location: '.PolarisCore::getUrl(array(), true, array('actpane')));
}

$windowType = "attributModifierWindow";
if(isset($_GET['windowType'])){
    $windowType = $_GET['windowType'];
}

