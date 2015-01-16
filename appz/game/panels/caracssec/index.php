<?php

use polarisapi\ui\categorie\VerticalList;
use polarisapi\ui\categorie\BlocList;

$pane = new VerticalList('CARACSEC', $selectedPlayer);
echo $pane->build();

$pane = new VerticalList('SEUILSBLESSURES', $selectedPlayer);
echo $pane->build();


