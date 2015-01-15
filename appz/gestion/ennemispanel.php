<?php

use \PolarisCore;
use polarisapi\data\View;
use polarisapi\data\attribut\Attribut;
use polarisapi\objects\Pnj;

$view = new View('PNJ', null, null, '', array('PNJ_NOM'));




echo '<div id="ennemisPanel">';
echo '<div style="height:10px;"></div>';
foreach($view AS $viewItem){
    
    echo '<div class="playerName">'.$viewItem['PNJ_NOM'].'</div>';
    echo '<div class="player">';
    
	echo '<div class="col1">';
	    $attr = array();
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'PNJ_BLESSURE_INCONSCIENCE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'PNJ_BLESSURE_LEGERE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'PNJ_BLESSURE_GRAVE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'PNJ_BLESSURE_CRITIQUE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'PNJ_BLESSURE_FATAL');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'PNJ_BLESSURE_MORT');
            
            $seuils = array();
            $seuils[] = null;
            $seuils[] = Attribut::getAttribut($viewItem['id'], 'PNJ_SEUIL_INCONSCIENCE');
	    $seuils[] = Attribut::getAttribut($viewItem['id'], 'PNJ_SEUIL_LEGERE');
	    $seuils[] = Attribut::getAttribut($viewItem['id'], 'PNJ_SEUIL_GRAVE');
	    $seuils[] = Attribut::getAttribut($viewItem['id'], 'PNJ_SEUIL_CRITIQUE');
	    $seuils[] = Attribut::getAttribut($viewItem['id'], 'PNJ_SEUIL_FATAL');
	    $seuils[] = Attribut::getAttribut($viewItem['id'], 'PNJ_SEUIL_MORT');
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
	    $player = new Pnj($viewItem['id']);
	    if($player->isArmeCorpsACorps()){
		echo '<div class="subTitle">Arme de corps à corps :</div>';
		echo '<div class="subValue">'.$player->getArmeCorpsACorpsName().' (Res : '.(int)$player->getResArmeCorpsACorps().')</div>';
		if($player->getResArmeCorpsACorps() == 0){
		    echo '<div class="subValue"><b style="color:red">Arme déffectueuse (resistance épuisée)</b></div>';
		}
		echo '<div class="separation"></div>';
	    }else{
		echo '<div class="subTitle">Arme de corps à corps : <b style="color:red">NON</b></div>';
		echo '<div class="separation"></div>';
	    }
	    
	    if($player->isArmeDistance()){
		echo '<div class="subTitle">Arme à distance :</div>';
		echo '<div class="subValue">'.$player->getArmeDistanceName().' (Res : '.(int)$player->getResArmeDistance().')</div>';
		if($player->getResArmeDistance() == 0){
		    echo '<div class="subValue"><b style="color:red">Arme déffectueuse (resistance épuisée)</b></div>';
		}
		echo '<div class="separation"></div>';
	    }else{
		echo '<div class="subTitle">Arme à distance : <b style="color:red">NON</b></div>';
		echo '<div class="separation"></div>';
	    }
	    
	    echo '<div class="subTitle">Protection : '.$player->getProtection().'</div>';
	    echo '<div class="separation"></div>';
	
	    $inconscient = Attribut::getAttribut($viewItem['id'], 'PNJ_INCONSCIENT');
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
	
	//Actions
	echo '<div class="separation"></div>';
    
	//Suppression
	$delUrl = PolarisCore::getUrl(array('deletePnj' => $viewItem['id']), true, array());
	echo '<a class="actBlueButton" href="'.$delUrl.'">Supprimer</a>';
	
	
	echo '</div>';
}
echo '</div>';