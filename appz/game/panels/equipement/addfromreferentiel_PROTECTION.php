<?php

use polarisapi\ui\utils\ViewTable;
use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;


$view = new View(
        'REF_PROTECTION', 
        'v_REF_PROTECTION_DESIGNATION.tt_valeur', 
        'ASC', 
        '', 
        array('REF_PROTECTION_DESIGNATION', 'REF_PROTECTION_LOCALISATION', 'REF_PROTECTION_PROTECTION', 'REF_PROTECTION_RESISTANCE', 'REF_PROTECTION_SPECIAL'),
        null);
$wt = new ViewTable(
        $view, 
        array('REF_PROTECTION_DESIGNATION' => 'Désignation', 'REF_PROTECTION_LOCALISATION' => 'Localisation', 'REF_PROTECTION_PROTECTION' => 'Protection', 'REF_PROTECTION_RESISTANCE' => 'Resistance', 'REF_PROTECTION_SPECIAL' => 'Spécial'), 
        false,
        array(),
        array(),
        false,
        false,
        null,
        'PROTECTION',
        $_GET['player']);
$fc = new FreeCategorie('Protections');

echo $wt->build();