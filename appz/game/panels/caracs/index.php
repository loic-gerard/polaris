<?php

use polarisapi\ui\categorie\CaracList;
use polarisapi\ui\categorie\BlocList;

$pane = new BlocList('GENERAL', $selectedPlayer);
echo $pane->build();

$pane = new CaracList('CARACTERISTIQUES', $selectedPlayer);
echo $pane->build();
