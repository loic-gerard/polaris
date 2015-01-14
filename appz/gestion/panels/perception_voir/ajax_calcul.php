<?php


use polarisapi\data\Paliers;
use polarisapi\data\JetPerception;

//Calcul du pourcentage
$mods = array($_POST['mod1'], $_POST['mod2']);
if($_POST['type']=='pj'){
    $data = JetPerception::getSuccessPorcent('PERCEPTION', null, $_POST['joueur'], $_POST['intensite'], $_POST['diffBase'], $mods);
}else{
    $data = JetPerception::getSuccessPorcent('PNJ_PERCEPTION', null, $_POST['pnj'], $_POST['intensite'], $_POST['diffBase'], $mods);
}


echo '<div class="smallCol">';
echo '<table>';
foreach($data AS $d => $v){
    echo '<tr>';
        echo '<td>'.$d.'</td>';
        echo '<td>'.$v.'</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';
        
echo '<div class="smallCol">';
echo Paliers::renderPalierColumn($data['total']);
echo '</div>';