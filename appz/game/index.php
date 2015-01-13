<?php

use \PolarisCore;

include 'playermenu.php';

$selectedPlayer = PolarisCore::getFromUrl('player',null);
if($selectedPlayer){
    include 'actionmenu.php';
    
    $selectedPane = PolarisCore::getFromUrl('panel', null);
    
    echo '<div class="gamePanel">';
    include 'panels/'.$selectedPane.'/index.php';
    echo '</div>';
}



