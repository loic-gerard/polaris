<?php

use polarisapi\ui\menu\Menu;
use polarisapi\data\View;

$mainMenuView = new View('MAINMENU', null, null, null, array('NOMMENU', 'CODEAPPZ'));
$mainMenu = new Menu($mainMenuView, 'mainMenu', array('appz' => 'CODEAPPZ'), 'game', false, array());

echo $mainMenu->build();