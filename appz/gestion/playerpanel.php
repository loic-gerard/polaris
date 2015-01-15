<?php

use \PolarisCore;
use polarisapi\data\View;
use polarisapi\data\attribut\Attribut;
use polarisapi\objects\Player;

$selectedPane = PolarisCore::getFromUrl('panel', 'home');
$view = new View('PJ', null, null, '', array('NOM'));

echo '<div id="playerPanel">';
echo '<div style="height:10px;"></div>';
foreach($view AS $viewItem){
    echo '<div class="playerName">'.$viewItem['NOM'].'</div>';
    
    //Belle idée
	echo '<a class="actBlueButtonR" href="javascript:addProgressionPoint(\''.$viewItem['id'].'\',\'IDEE\',\'\');">Idée !</a>';
	
	//Belle action
	echo '<a class="actBlueButtonR" href="javascript:addProgressionPoint(\''.$viewItem['id'].'\',\'ACTION\',\'\');">Action !</a>';
	
	//Belle interprétation
	echo '<a class="actBlueButtonR" href="javascript:addProgressionPoint(\''.$viewItem['id'].'\',\'INTERPRETATION\',\'\');">Interprétation !</a>';
        echo '<div class="clear"></div>';
        
    echo '<div class="player">';
    
	echo '<div class="col1">';
	    $attr = array();
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'FATIGUE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_INCONSCIENCE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_LEGERE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_GRAVE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_CRITIQUE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_FATAL');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_MORT');
            
            $seuils = array();
            $seuils[] = null;
            $seuils[] = Attribut::getAttribut($viewItem['id'], 'SEUIL_INCONSCIENCE');
	    $seuils[] = Attribut::getAttribut($viewItem['id'], 'SEUIL_LEGERE');
	    $seuils[] = Attribut::getAttribut($viewItem['id'], 'SEUIL_GRAVE');
	    $seuils[] = Attribut::getAttribut($viewItem['id'], 'SEUIL_CRITIQUE');
	    $seuils[] = Attribut::getAttribut($viewItem['id'], 'SEUIL_FATAL');
	    $seuils[] = Attribut::getAttribut($viewItem['id'], 'SEUIL_MORT');
            $i = 0;
	    foreach($attr AS $a){
                
                $seuil = '';
                if($seuils[$i]){
                    $seuil = $seuils[$i]->getFinalValue();
                }
		echo $a->renderForSmartDisplay($seuil);
		echo '<div class="clear"></div>';
                
                $i++;
	    }
	    echo '<div class="clear"></div>';
	echo '</div>';

	echo '<div class="col2">';
            $url = PolarisCore::getUrl(array('appz' => 'game', 'player' => $viewItem['id'], 'panel' => 'equipement'), false);

            echo '<div class="subTitle"><a class="bluelink" href="'.$url.'">Armes:</a></div>';
	    $player = new Player($viewItem['id']);
	    if($player->isArmeCorpsACorps()){
		
		echo '<div class="subValue"><b>'.$player->getArmeCorpsACorpsName().'</b> (Res : '.(int)$player->getResArmeCorpsACorps().')</div>';
		if($player->getResArmeCorpsACorps() == 0){
		    echo '<div class="subValue"><b style="color:red">Arme déffectueuse (resistance épuisée)</b></div>';
		}
	    }else{
		echo '<div class="subTitle"><b style="color:red">Pas d\'arme de corps à corps</b></div>';
		
	    }
	    
	    if($player->isArmeDistance()){
		echo '<div class="subValue"><b>'.$player->getArmeDistanceName().'</a></b> (Res : '.(int)$player->getResArmeDistance().' - Mun : '.(int)$player->getArmeDistanceMunitions().')</div>';
		if($player->getResArmeDistance() == 0){
		    echo '<div class="subValue"><b style="color:red">Arme déffectueuse (resistance épuisée)</b></div>';
		}
	    }else{
		echo '<div class="subTitle"><b style="color:red">Pas d\'arme à distance</b></div>';
	    }
	    echo '<div class="separation"></div>';
            
	    echo '<div class="subTitle"><a class="bluelink" href="'.$url.'">Protection : '.$player->getProtection().'</a></div>';
	    echo '<div class="separation"></div>';
	
	    $inconscient = Attribut::getAttribut($viewItem['id'], 'INCONSCIENT');
	    if($inconscient->getFinalValue() == 1){
		echo '<div class="subTitle">Inconscient : <b style="color:red;">OUI</b></div>';
		echo '<div class="separation"></div>';
	    }
	
	    $v = new View('HEMORRAGIE', 'pk_entite', 'ASC', '', array('HEMORRAGIE_TYPE'), $viewItem['id']);
	    if($v->count() > 0){
		echo '<div class="subTitle">Hemorragies : </div>';
		foreach($v AS $d){
		    echo '<div class="subValue" style="color:red;"><b>'.$d['HEMORRAGIE_TYPE'].'</b></div>';
		}
		echo '<div class="separation"></div>';
	    }
	    $v = new View('POISON', 'pk_entite', 'ASC', '', array('POISON_DESIGNATION', 'POISON_INTENSITE', 'POISON_EFFETS'), $viewItem['id']);
	    if($v->count() > 0){
		echo '<div class="subTitle">Poisons : </div>';
		foreach($v AS $d){
		    echo '<div class="subValue" style="color:red;"><b>'.$d['POISON_DESIGNATION'].' (Intensité : '.$d['POISON_INTENSITE'].')</b><br><i>'.$d['POISON_EFFETS'].'</i></div>';
		}
		echo '<div class="separation"></div>';
	    }
	    $v = new View('MALADIE', 'pk_entite', 'ASC', '', array('MALADIE_DESIGNATION', 'MALADIE_INTENSITE', 'MALADIE_EFFETS'), $viewItem['id']);
	    if($v->count() > 0){
		echo '<div class="subTitle">Maladies : </div>';
		foreach($v AS $d){
		    echo '<div class="subValue" style="color:red;"><b>'.$d['MALADIE_DESIGNATION'].' (Intensité : '.$d['MALADIE_INTENSITE'].')</b><br><i>'.$d['MALADIE_EFFETS'].'</i></div>';
		}
		echo '<div class="separation"></div>';
	    }
	echo '</div>';
    
	echo '<div class="clear"></div>';
	
	
    echo '</div>';
}
echo '</div>';