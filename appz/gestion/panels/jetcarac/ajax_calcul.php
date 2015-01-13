<?php


use polarisapi\data\Paliers;
use polarisapi\data\JetCarac;

//Calcul du pourcentage
$data = JetCarac::getSuccessPorcent(null, $_POST['attribut'], $_POST['joueur'], $_POST['intensite'], $_POST['margeadv']);


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