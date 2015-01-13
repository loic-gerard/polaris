<?php

use polarisapi\ui\utils\ViewTable;
use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;


$view = new View(
        'REF_PNJ', 
        'v_REF_PNJ_NOM.tt_valeur', 
        'ASC', 
        '', 
        array('REF_PNJ_NOM', 'REF_PNJ_NIV', 'REF_PNJ_DESC'),
        null);
$wt = new ViewTable(
        $view, 
        array('REF_PNJ_NOM' => 'Désignation', 'REF_PNJ_NIV' => 'Niveau de difficulté', 'REF_PNJ_DESC' => 'Description'), 
        false,
        array(),
        array(),
        false,
        false,
        null,
        'PNJ',
        null);
$fc = new FreeCategorie('Ennemi');

echo $wt->build();