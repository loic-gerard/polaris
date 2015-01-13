<?php

use polarisapi\ui\categorie\TalentList;

$pane = new TalentList('TALENTS', $selectedPlayer);
echo $pane->build();
