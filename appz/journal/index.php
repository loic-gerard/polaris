<?php

use polarisapi\data\View;
use polarisapi\ui\utils\ViewTable;
use polarisapi\ui\categorie\FreeCategorie;
use \PolarisCore;

$v = new View('JOURNAL', 'pk_entite', 'ASC', '', array('JOURNAL_DATE', 'JOURNAL_TEXTE'));

$output = '<table>';
$output .= '<tr class="header">';
$output .= '<td width="70">Date</td>';
$output .= '<td class="leftCell">Texte</td>';
$output .= '</tr>';
foreach($v AS $d){
    $output .= '<tr>';
    $output .= '<td width="100" class="modifiable" '.PolarisCore::getModifierUrl($d['id'], 'JOURNAL_DATE', true).' class="modifiable">'.$d['JOURNAL_DATE'].'</td>';
    $output .= '<td class="normalCell leftCell modifiable" '.PolarisCore::getModifierUrl($d['id'], 'JOURNAL_TEXTE', true).' class="modifiable">'.nl2br($d['JOURNAL_TEXTE']).'</td>';
    $output .= '</tr>';
}
$output .= '</table>';

$ft = new FreeCategorie('Journal');
echo $ft->build($output);
