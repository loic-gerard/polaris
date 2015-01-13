<?php

use polarisapi\ui\categorie\CaracList;
use polarisapi\ui\categorie\BlocList;
use polarisapi\ui\categorie\VerticalList;
use \PolarisCore;

echo '<div class="smallButtonsContainer"><a href="'.PolarisCore::getUrl(array(), true, array('detailId', 'detailPage')).'" class="smallBlueButton">Retour</a></div>';

$pane = new VerticalList(null, $_GET['detailId'], 'PNJ');
echo $pane->build();
