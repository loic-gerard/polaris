<?php

use polarisapi\ui\categorie\TalentList;

$pane = new TalentList('TALENTS_PHYSIQUES', $selectedPlayer);
echo $pane->build();

$pane = new TalentList('TALENTS_COMBAT', $selectedPlayer);
echo $pane->build();

$pane = new TalentList('TALENTS_SOCIAUX', $selectedPlayer);
echo $pane->build();

$pane = new TalentList('TALENTS_ARTISANAUX', $selectedPlayer);
echo $pane->build();

$pane = new TalentList('TALENTS_CONNAISSANCES', $selectedPlayer);
echo $pane->build();

$pane = new TalentList('TALENTS_COMMERCIAUX', $selectedPlayer);
echo $pane->build();

$pane = new TalentList('TALENTS_ARTISTIQUES', $selectedPlayer);
echo $pane->build();

$pane = new TalentList('TALENTS_MENTAUX', $selectedPlayer);
echo $pane->build();

$pane = new TalentList('TALENTS_NAVIGATION', $selectedPlayer);
echo $pane->build();

$pane = new TalentList('TALENTS_INVESTIGATION', $selectedPlayer);
echo $pane->build();

$pane = new TalentList('TALENTS_MEDICAUX', $selectedPlayer);
echo $pane->build();







