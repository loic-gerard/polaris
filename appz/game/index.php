<?php

use \PolarisCore;

include 'playermenu.php';

$selectedPlayer = PolarisCore::getFromUrl('player',null);
if($selectedPlayer){
    $selectedPane = PolarisCore::getFromUrl('panel', 'caracs');
    include 'actionmenu.php';
    
    
    
    echo '<div class="gamePanel">';
    include 'panels/'.$selectedPane.'/index.php';
    echo '</div>';
}



