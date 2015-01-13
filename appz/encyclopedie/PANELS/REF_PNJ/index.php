<?php

use polarisapi\ui\utils\ViewTable;
use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;


//'REF_PNJ_NOM', 'REF_PNJ_NIV', 'REF_PNJ_DESC', 'REF_PNJ_AGI', 'REF_PNJ_FOR', 'REF_PNJ_RES', 'REF_PNJ_GAB', 'REF_PNJ_RAP', 'REF_PNJ_CHA', 'REF_PNJ_VOL', 'REF_PNJ_INT', 'REF_PNJ_SGF', 'REF_PNJ_INS', 'REF_PNJ_REACTION', 'REF_PNJ_PERCEPTION', 'REF_PNJ_SEUIL_INCONSCIENCE', 'REF_PNJ_SEUIL_LEGERE', 'REF_PNJ_SEUIL_GRAVE', 'REF_PNJ_SEUIL_CRITIQUE', 'REF_PNJ_SEUIL_FATALE', 'REF_PNJ_SEUIL_MORT', 'REF_PNJ_ATTAQUE', 'REF_PNJ_ESQUIVE', 'REF_PNJ_PARADE', 'REF_PNJ_FATIGUE', 'REF_PNJ_DEGATS', 'REF_PNJ_NBATTAQUES', 'REF_PNJ_ARMURE', 'REF_PNJ_BLINDAGE', 'REF_PNJ_SPE'

//'REF_PNJ_NOM', 'REF_PNJ_NIV', 'REF_PNJ_DESC' 


$view = new View(
        'REF_PNJ', 
        'v_REF_PNJ_NOM.tt_valeur', 
        'ASC', 
        '', 
        array('REF_PNJ_NOM', 'REF_PNJ_NIV', 'REF_PNJ_DESC' ),
        null);
$wt = new ViewTable(
        $view, 
        array('REF_PNJ_NOM' => 'Désignation', 'REF_PNJ_NIV' => 'Niveau de difficulté', 'REF_PNJ_DESC' => 'Description' ), 
        true,
        array('REF_PNJ_NOM', 'REF_PNJ_NIV', 'REF_PNJ_DESC' ),
        array(),
        true,
        true,
        null,
	false,
	0,
	'appz/encyclopedie/PANELS/REF_PNJ/details.php');
$fc = new FreeCategorie('Ennemis / créatures');

echo $fc->build($wt->build());