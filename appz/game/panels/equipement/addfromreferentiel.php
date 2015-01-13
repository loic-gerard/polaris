<?php

use polarisapi\ui\utils\ViewTable;
use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;


$view = new View(
        'REF_ARMEDISTANCE', 
        'pk_entite', 
        'ASC', 
        '', 
        array('REF_ARMEDISTANCE_DESIGNATION', 'REF_ARMEDISTANCE_TYPE', 'REF_ARMEDISTANCE_MILIEU', 'REF_ARMEDISTANCE_DEGATSPHYS', 'REF_ARMEDISTANCE_DEGATSCHOC'),
        null);
$wt = new ViewTable(
        $view, 
        array('REF_ARMEDISTANCE_DESIGNATION' => 'Désignation', 'REF_ARMEDISTANCE_DEGATSPHYS' => 'Dégats physiques', 'REF_ARMEDISTANCE_DEGATSCHOC' => 'Dégats de choc', 'REF_ARMEDISTANCE_MILIEU' => 'Milieu', 'REF_ARMEDISTANCE_TYPE' => 'Type'), 
        false,
        array(),
        array(),
        false,
        false,
        null,
        'ARMEDISTANCE',
        $_GET['player']);
$fc = new FreeCategorie('Arme à distance');

echo $wt->build();