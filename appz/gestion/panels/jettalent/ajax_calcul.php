<?php


use polarisapi\data\Paliers;
use polarisapi\data\JetTalent;
use polarisapi\data\attribut\Attribut;


//Calcul du pourcentage
$data = JetTalent::getSuccessPorcent(null, $_POST['attribut'], $_POST['joueur'], $_POST['intensite']);
$a = Attribut::getAttribut($_POST['joueur'], null, $_POST['attribut']);
$attrCode = $a->getAttributCode();

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
        
echo '<div class="smallCol" style="width:200px">';
echo Paliers::renderPalierColumn($data['total']);
echo '<br><br><a class="actBlueButton" href="javascript:addProgressionPoint(\''.$_POST['joueur'].'\',\'TALENT\',\''.$attrCode.'\');">Réussite ou échec critique</a>';
echo '</div>';