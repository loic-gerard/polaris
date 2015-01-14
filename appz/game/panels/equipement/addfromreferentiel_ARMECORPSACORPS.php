<?php

use polarisapi\ui\utils\ViewTable;
use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;


$view = new View(
        'REF_ARMECORPSACORPS', 
        'pk_entite', 
        'ASC', 
        '', 
        array('REF_ARMECORPSACORPS_DESIGNATION','REF_ARMECORPSACORPS_TYPE','REF_ARMECORPSACORPS_TALENT','REF_ARMECORPSACORPS_DEGATSPHYS','REF_ARMECORPSACORPS_DEGATSCHOC','REF_ARMECORPSACORPS_RESISTANCE'),
        null);
$wt = new ViewTable(
        $view, 
        array('REF_ARMECORPSACORPS_DESIGNATION' => 'Designation','REF_ARMECORPSACORPS_TYPE' => 'Type','REF_ARMECORPSACORPS_TALENT' => 'Talent','REF_ARMECORPSACORPS_DEGATSPHYS' => 'Dégats physiques','REF_ARMECORPSACORPS_DEGATSCHOC' => 'Dégats de choc','REF_ARMECORPSACORPS_RESISTANCE' => 'Resistance'), 
        false,
        array(),
        array(),
        false,
        false,
        null,
        'ARMECORPSACORPS',
        $_GET['player']);
$fc = new FreeCategorie('Arme de corps à corps');

echo $wt->build();