<?php

use polarisapi\ui\utils\ViewTable;
use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;

//'PROTECTION_DESIGNATION', 'PROTECTION_LOCALISATION', 'PROTECTION_PROTECTION', 'PROTECTION_RESISTANCE','PROTECTION_SPECIAL','PROTECTION_USURE','PROTECTION_EQUIPED'

$view = new View(
        'PROTECTION', 
        'pk_entite', 
        'ASC', 
        '', 
        array('PROTECTION_DESIGNATION', 'PROTECTION_LOCALISATION', 'PROTECTION_PROTECTION', 'PROTECTION_RESISTANCE','PROTECTION_SPECIAL','PROTECTION_USURE','PROTECTION_EQUIPED'),
        $selectedPlayer);
$wt = new ViewTable(
        $view, 
        array('PROTECTION_DESIGNATION' => 'Designation', 'PROTECTION_LOCALISATION' => 'Localisation', 'PROTECTION_PROTECTION' => 'Protection', 'PROTECTION_RESISTANCE' => 'Resistance','PROTECTION_SPECIAL' => 'Spécial','PROTECTION_USURE' => 'Usure'), 
        true,
        array('PROTECTION_DESIGNATION', 'PROTECTION_LOCALISATION', 'PROTECTION_PROTECTION', 'PROTECTION_RESISTANCE','PROTECTION_SPECIAL','PROTECTION_USURE'),
        array(),
        true,
        true,
        'appz/game/panels/equipement/addfromreferentiel_PROTECTION.php',
        false,
	0,
	null,
	'PROTECTION_EQUIPED');
$fc = new FreeCategorie('Protections');

echo $fc->build($wt->build());


$view = new View(
        'ARMEDISTANCE', 
        'pk_entite', 
        'ASC', 
        '', 
        array('ARMEDISTANCE_DESIGNATION', 'ARMEDISTANCE_TYPE', 'ARMEDISTANCE_MILIEU', 'ARMEDISTANCE_DEGATSPHYS', 'ARMEDISTANCE_DEGATSCHOC', 'ARMEDISTANCE_PORTEE1', 'ARMEDISTANCE_PORTEE2', 'ARMEDISTANCE_PORTEE3', 'ARMEDISTANCE_PORTEE4', 'ARMEDISTANCE_CADENCE', 'ARMEDISTANCE_MUNITIONS', 'ARMEDISTANCE_EQUIPED', 'ARMEDISTANCE_RESISTANCE', 'ARMEDISTANCE_TALENT'),
        $selectedPlayer);
$wt = new ViewTable(
        $view, 
        array('ARMEDISTANCE_DESIGNATION' => 'Désignation', 'ARMEDISTANCE_TYPE' => 'Type', 'ARMEDISTANCE_MILIEU' => 'Milieu', 'ARMEDISTANCE_DEGATSPHYS' => 'Dégats physiques', 'ARMEDISTANCE_DEGATSCHOC' => 'Dégats de choc', 'ARMEDISTANCE_PORTEE1' => 'Port. courte', 'ARMEDISTANCE_PORTEE2' => 'Port. moy.', 'ARMEDISTANCE_PORTEE3' => 'Port. longue', 'ARMEDISTANCE_PORTEE4' => 'Port. ext.', 'ARMEDISTANCE_CADENCE'=> 'Cadence', 'ARMEDISTANCE_MUNITIONS' => 'Munitions', 'ARMEDISTANCE_RESISTANCE' => 'Resistance'), 
        true,
        array('ARMEDISTANCE_DESIGNATION', 'ARMEDISTANCE_TYPE', 'ARMEDISTANCE_MILIEU', 'ARMEDISTANCE_DEGATSPHYS', 'ARMEDISTANCE_DEGATSCHOC', 'ARMEDISTANCE_PORTEE1', 'ARMEDISTANCE_PORTEE2', 'ARMEDISTANCE_PORTEE3', 'ARMEDISTANCE_PORTEE4', 'ARMEDISTANCE_CADENCE', 'ARMEDISTANCE_MUNITIONS', 'ARMEDISTANCE_RESISTANCE', 'ARMEDISTANCE_TALENT'),
        array(),
        true,
        true,
        'appz/game/panels/equipement/addfromreferentiel_ARMEDISTANCE.php',
	false,
	0,
	null,
	'ARMEDISTANCE_EQUIPED');
$fc = new FreeCategorie('Armes à distance');

echo $fc->build($wt->build());



$view = new View(
        'ARMECORPSACORPS', 
        'pk_entite', 
        'ASC', 
        '', 
        array('ARMECORPSACORPS_DESIGNATION','ARMECORPSACORPS_TYPE','ARMECORPSACORPS_TALENT','ARMECORPSACORPS_DEGATSPHYS','ARMECORPSACORPS_DEGATSCHOC','ARMECORPSACORPS_RESISTANCE', 'ARMECORPSACORPS_EQUIPED'),
        $selectedPlayer);
$wt = new ViewTable(
        $view, 
        array('ARMECORPSACORPS_DESIGNATION' => 'Designation','ARMECORPSACORPS_TYPE' => 'Type','ARMECORPSACORPS_TALENT' => 'Talent','ARMECORPSACORPS_DEGATSPHYS' => 'Dégats physiques','ARMECORPSACORPS_DEGATSCHOC' => 'Dégats choc','ARMECORPSACORPS_RESISTANCE' => 'Resistance'), 
        true,
        array('ARMECORPSACORPS_DESIGNATION','ARMECORPSACORPS_TYPE','ARMECORPSACORPS_TALENT','ARMECORPSACORPS_DEGATSPHYS','ARMECORPSACORPS_DEGATSCHOC','ARMECORPSACORPS_RESISTANCE'),
        array(),
        true,
        true,
        'appz/game/panels/equipement/addfromreferentiel_ARMECORPSACORPS.php',
	false,
	0,
	null,
	'ARMECORPSACORPS_EQUIPED');
$fc = new FreeCategorie('Armes de corps à corps');

echo $fc->build($wt->build());