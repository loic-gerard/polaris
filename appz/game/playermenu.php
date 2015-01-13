<?php

use polarisapi\ui\menu\Menu;
use polarisapi\data\View;

$playerMenuView = new View('PJ', null, null, null, array('NOM'));
$playerMenu = new Menu($playerMenuView, 'col1Menu', array('player' => '%'), null, true, array());

echo '<div id="col1Menu">';
echo $playerMenu->build();
echo '</div>';

