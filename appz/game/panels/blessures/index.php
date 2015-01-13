<?php

use polarisapi\ui\categorie\VerticalList;
use polarisapi\ui\categorie\BlocList;
use polarisapi\ui\utils\ViewTable;
use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;

$pane = new VerticalList('FATIGUE', $selectedPlayer);
echo $pane->build();

$pane = new VerticalList('BLESSURES', $selectedPlayer);
echo $pane->build();


$view = new View(
        'HEMORRAGIE', 
        'pk_entite', 
        'ASC', 
        null, 
        array('HEMMORRAGIE_TYPE'),
        $selectedPlayer);
$wt = new ViewTable(
        $view, 
        array('HEMORRAGIE_TYPE' => 'Type'), 
        true,
        array('HEMORRAGIE_TYPE'),
        array(),
        true,
        true);
$fc = new FreeCategorie('Hemorragies');

echo $fc->build($wt->build());



$view = new View(
        'MALADIE', 
        'pk_entite', 
        'ASC', 
        null, 
        array('MALADIE_DESIGNATION', 'MALADIE_INTENSITE', 'MALADIE_EFFETS'),
        $selectedPlayer);
$wt = new ViewTable(
        $view, 
        array('MALADIE_DESIGNATION' => 'Désignation', 'MALADIE_INTENSITE' => 'Intensité', 'MALADIE_EFFETS' => 'Effets'), 
        true,
        array('MALADIE_DESIGNATION', 'MALADIE_INTENSITE', 'MALADIE_EFFETS'),
        array(),
        true,
        true);
$fc = new FreeCategorie('Maladies');

echo $fc->build($wt->build());


$view = new View(
        'POISON', 
        'pk_entite', 
        'ASC', 
        null, 
        array('POISON_DESIGNATION', 'POISON_INTENSITE', 'POISON_EFFETS'),
        $selectedPlayer);
$wt = new ViewTable(
        $view, 
        array('POISON_DESIGNATION' => 'Désignation', 'POISON_INTENSITE' => 'Intensité', 'POISON_EFFETS' => 'Effets'), 
        true,
        array('POISON_DESIGNATION', 'POISON_INTENSITE', 'POISON_EFFETS'),
        array(),
        true,
        true);
$fc = new FreeCategorie('Poisons');

echo $fc->build($wt->build());