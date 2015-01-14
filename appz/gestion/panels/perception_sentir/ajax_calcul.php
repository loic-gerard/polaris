<?php


use polarisapi\data\Paliers;
use polarisapi\data\JetPerception;

//Calcul du pourcentage
if($_POST['type']=='pj'){
    $data = JetPerception::getSuccessPorcent('PERCEPTION', null, $_POST['joueur'], $_POST['intensite'], $_POST['diffBase'], array());
}else{
    $data = JetPerception::getSuccessPorcent('PNJ_PERCEPTION', null, $_POST['pnj'], $_POST['intensite'], $_POST['diffBase'], array());
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