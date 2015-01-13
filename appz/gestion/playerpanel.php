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
}
echo '</div>';