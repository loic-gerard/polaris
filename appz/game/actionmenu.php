<?php

use polarisapi\ui\menu\Menu;
use polarisapi\data\View;

$amMenuView = new View('ACTIONMENU', null, null, null, array('ACTIONMENU_NOM', 'ACTIONMENU_CODE'));
$amMenu = new Menu($amMenuView, 'col2Menu', array('panel' => 'ACTIONMENU_CODE'), null, true, array());

echo '<div id="col2Menu">';
echo $amMenu->build();
echo '</div>';

