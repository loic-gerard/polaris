<?php

use \PolarisCore;
use polarisapi\data\View;
use polarisapi\data\attribut\Attribut;

$selectedPane = PolarisCore::getFromUrl('panel', 'home');
$view = new View('PJ');

echo '<div id="playerPanel">';
echo '<div class="title">Joueurs</div>';
foreach($view AS $viewItem){
    echo '<div class="player">';
    
	echo '<div class="col1">';
	    $attr = array();
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_INCONSCIENCE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_LEGERE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_GRAVE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_CRITIQUE');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_FATAL');
	    $attr[] = Attribut::getAttribut($viewItem['id'], 'BLESSURE_MORT');
	    foreach($attr AS $a){
		echo $a->renderForDisplay();
		echo '<div class="clear"></div>';
	    }
	    echo '<div class="clear"></div>';
	echo '</div>';

	echo '<div class="col2">';
	    $inconscient = Attribut::getAttribut($viewItem['id'], 'INCONSCIENT');
	    if($inconscient->getFinalValue() == 1){
		echo '<div class="subTitle">Inconscient : OUI</div>';
		echo '<div class="separation"></div>';
	    }
	
	    $v = new View('HEMORRAGIE', 'pk_entite', 'ASC', '', array('HEMORRAGIE_TYPE'), $viewItem['id']);
	    if($v->count() > 0){
		echo '<div class="subTitle">Hemorragies : </div>';
		foreach($v AS $d){
		    echo '<div class="subValue">'.$d['HEMORRAGIE_TYPE'].'</div>';
		}
		echo '<div class="separation"></div>';
	    }
	    $v = new View('POISON', 'pk_entite', 'ASC', '', array('POISON_DESIGNATION', 'POISON_INTENSITE', 'POISON_EFFETS'), $viewItem['id']);
	    if($v->count() > 0){
		echo '<div class="subTitle">Poisons : </div>';
		foreach($v AS $d){
		    echo '<div class="subValue"><b>'.$d['POISON_DESIGNATION'].' (Intensité : '.$d['POISON_INTENSITE'].')</b><br><i>'.$d['POISON_EFFETS'].'</i></div>';
		}
		echo '<div class="separation"></div>';
	    }
	    $v = new View('MALADIE', 'pk_entite', 'ASC', '', array('MALADIE_DESIGNATION', 'MALADIE_INTENSITE', 'MALADIE_EFFETS'), $viewItem['id']);
	    if($v->count() > 0){
		echo '<div class="subTitle">Maladies : </div>';
		foreach($v AS $d){
		    echo '<div class="subValue"><b>'.$d['MALADIE_DESIGNATION'].' (Intensité : '.$d['MALADIE_INTENSITE'].')</b><br><i>'.$d['MALADIE_EFFETS'].'</i></div>';
		}
		echo '<div class="separation"></div>';
	    }
	echo '</div>';
    
	echo '<div class="clear"></div>';
    echo '</div>';
}
echo '</div>';