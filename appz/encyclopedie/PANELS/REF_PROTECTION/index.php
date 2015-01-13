<?php

use polarisapi\ui\utils\ViewTable;
use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;

//'REF_PROTECTION_DESIGNATION', 'REF_PROTECTION_LOCALISATION', 'REF_PROTECTION_PROTECTION', 'REF_PROTECTION_RESISTANCE','REF_PROTECTION_SPECIAL'

	
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
        true,
        array('REF_PROTECTION_DESIGNATION', 'REF_PROTECTION_LOCALISATION', 'REF_PROTECTION_PROTECTION', 'REF_PROTECTION_RESISTANCE','REF_PROTECTION_SPECIAL'),
        array(),
        true,
        true,
        null);
$fc = new FreeCategorie('Equipements de protection');

echo $fc->build($wt->build());