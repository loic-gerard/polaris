<?php


use polarisapi\data\Paliers;
use polarisapi\data\JetCarac;
use polarisapi\ui

//Calcul du pourcentage
if($_POST['type'] == 'pj'){
    $data = JetCarac::getSuccessPorcent(null, $_POST['attributpj'], $_POST['joueur'], $_POST['intensite'], $_POST['margeadv']);
}else{
    $data = JetCarac::getSuccessPorcent(null, $_POST['attributpnj'], $_POST['pnj'], $_POST['intensite'], $_POST['margeadv']);
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
echo '<br><br><a class="actBlueButton" href="javascript:addProgressionPoint(\''.$_GET['idAttaquant'].'\',\'TALENT\',\''.$defenseur->getTalentCodeArmeCorpsACorps().'\');">Réussite ou échec critique</a>';
echo '</div>';