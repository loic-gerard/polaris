<?php

use polarisapi\ui\utils\ViewTable;
use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;

$view = new View(
        'CONTACT', 
        'pk_entite', 
        'ASC', 
        'v_CONTACT_TYPE.tt_valeur=\'CONTACT\'', 
        array('CONTACT_TYPE', 'CONTACT_NOM', 'CONTACT_LOCALISATION', 'CONTACT_DETAILS'),
        $selectedPlayer);
$wt = new ViewTable(
        $view, 
        array('CONTACT_NOM' => 'Nom', 'CONTACT_LOCALISATION' => 'Dernière localisation connue', 'CONTACT_DETAILS' => 'Détails'), 
        true,
        array('CONTACT_NOM', 'CONTACT_LOCALISATION', 'CONTACT_DETAILS'),
        array('CONTACT_TYPE' => 'CONTACT'),
        true,
        true);
$fc = new FreeCategorie('Contacts');

echo $fc->build($wt->build());



$view = new View(
        'CONTACT', 
        'pk_entite', 
        'ASC', 
        'v_CONTACT_TYPE.tt_valeur=\'ALLIE\'', 
        array('CONTACT_TYPE', 'CONTACT_NOM', 'CONTACT_LOCALISATION', 'CONTACT_DETAILS'),
        $selectedPlayer);
$wt = new ViewTable(
        $view, 
        array('CONTACT_NOM' => 'Nom', 'CONTACT_LOCALISATION' => 'Dernière localisation connue', 'CONTACT_DETAILS' => 'Détails'), 
        true,
        array('CONTACT_NOM', 'CONTACT_LOCALISATION', 'CONTACT_DETAILS'),
        array('CONTACT_TYPE' => 'ALLIE'),
        true,
        true);
$fc = new FreeCategorie('Alliés');

echo $fc->build($wt->build());


$view = new View(
        'CONTACT', 
        'pk_entite', 
        'ASC', 
        'v_CONTACT_TYPE.tt_valeur=\'ENNEMI\'', 
        array('CONTACT_TYPE', 'CONTACT_NOM', 'CONTACT_LOCALISATION', 'CONTACT_DETAILS'),
        $selectedPlayer);
$wt = new ViewTable(
        $view, 
        array('CONTACT_NOM' => 'Nom', 'CONTACT_LOCALISATION' => 'Dernière localisation connue', 'CONTACT_DETAILS' => 'Détails'), 
        true,
        array('CONTACT_NOM', 'CONTACT_LOCALISATION', 'CONTACT_DETAILS'),
        array('CONTACT_TYPE' => 'ENNEMI'),
        true,
        true);
$fc = new FreeCategorie('Ennemis');

echo $fc->build($wt->build());