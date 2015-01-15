   <?php

   use polarisapi\data\View;
use polarisapi\ui\categorie\FreeCategorie;
use polarisapi\data\attribut\Attribut;
use polarisapi\data\Entite;

$joueurs = new View('PJ', 'v_NOM.tt_valeur', 'ASC', '', array('NOM'));

   



   echo '<a class="smallBlueButton" href="' . PolarisCore::getUrl(array('progression' => 1), true, array()) . '">Fin de l\'aventure en cours</a>';
   echo '<br><br><br>';


   foreach ($joueurs AS $joueur) {
       $content = '';

       $talents = array();
       $idees = 0;
       $actions = 0;
       $interpretation = 0;
       $aventure = 0;

       $points = new View('EVOLUTION', null, null, '', array('EVOLUTION_TALENT', 'EVOLUTION_TYPE', 'EVOLUTION_DESIGNATION'), $joueur['id']);
       foreach ($points AS $p) {
	   if ($p['EVOLUTION_TYPE'] == 'TALENT') {
	       //$a = Attribut::getAttribut($joueur['id'], $p['EVOLUTION_TALENT']);
	       $talents[] = $p['EVOLUTION_DESIGNATION'] . ' (1D6)';
	   } else if ($p['EVOLUTION_TYPE'] == 'INTERPRETATION') {
	       $interpretation += 0.25;
	   } else if ($p['EVOLUTION_TYPE'] == 'IDEE') {
	       $idees += 0.25;
	   } else if ($p['EVOLUTION_TYPE'] == 'ACTION') {
	       $actions += 0.25;
	   } else if ($p['EVOLUTION_TYPE'] == 'AVENTURE') {
	       $aventure += 0.25;
	   }
       }

       $content .= '<b>Evolution des talents</b><br>';
       $content .= '<table>';
       foreach ($talents AS $t) {
	   $content .= '<tr>';
	   $content .= '<td>' . $t . '</td>';
	   $content .= '</tr>';
       }
       $content .= '</table>';

       $content .= '<br><br>';
       $content .= '<b>Points de progression</b><br>';
       $content .= '<table>';
       $content .= '<tr><td>Points d\'idées : ' . $idees . '</td></tr>';
       $content .= '<tr><td>Points d\'action : ' . $actions . '</td></tr>';
       $content .= '<tr><td>Points d\'interprétation : ' . $interpretation . '</td></tr>';
       $content .= '<tr><td>Points d\'aventure : ' . $aventure . '</td></tr>';
       $content .= '</table>';

       $panel = new FreeCategorie($joueur['NOM']);
       echo $panel->build($content);
   }
