<?php

use polarisapi\ui\utils\ViewTable;
use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;


$view = new View(
        'ARMEDISTANCE', 
        'pk_entite', 
        'ASC', 
        '', 
        array('ARMEDISTANCE_DESIGNATION', 'ARMEDISTANCE_TYPE', 'ARMEDISTANCE_MILIEU', 'ARMEDISTANCE_DEGATSPHYS', 'ARMEDISTANCE_DEGATSCHOC', 'ARMEDISTANCE_MUNITIONS', 'ARMEDISTANCE_EQUIPED'),
        $selectedPlayer);
$wt = new ViewTable(
        $view, 
        array('ARMEDISTANCE_DESIGNATION' => 'Désignation', 'ARMEDISTANCE_TYPE' => 'Type', 'ARMEDISTANCE_MILIEU' => 'Milieu', 'ARMEDISTANCE_DEGATSPHYS' => 'Dégats physiques', 'ARMEDISTANCE_DEGATSCHOC' => 'Dégats de choc', 'ARMEDISTANCE_MUNITIONS' => 'Munitions'), 
        true,
        array('ARMEDISTANCE_DESIGNATION', 'ARMEDISTANCE_TYPE', 'ARMEDISTANCE_MILIEU', 'ARMEDISTANCE_DEGATSPHYS', 'ARMEDISTANCE_DEGATSCHOC', 'ARMEDISTANCE_MUNITIONS'),
        array(),
        true,
        true,
        'appz/game/panels/equipement/addfromreferentiel.php');
$fc = new FreeCategorie('Armes à distance');

echo $fc->build($wt->build());