<?php

use \PolarisCore;
use polarisapi\data\View;
use polarisapi\data\attribut\Attribut;

include 'playerpanel.php';
include 'ennemispanel.php';

echo '<div id="actionsPanel">';
include 'panels/' . $selectedPane . '/index.php';
echo '</div>';
