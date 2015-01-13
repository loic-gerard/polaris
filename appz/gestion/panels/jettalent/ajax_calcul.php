<?php


use polarisapi\data\Paliers;
use polarisapi\data\JetTalent;

//Calcul du pourcentage
$data = JetTalent::getSuccessPorcent(null, $_POST['attribut'], $_POST['joueur'], $_POST['intensite']);


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