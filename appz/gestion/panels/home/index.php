<?php

use \PolarisCore;

?>

Par joueur :
+ bonne idée !
+ belle action !
+ belle interpretation !


<div class="categorie">Combat</div>
<div class="boutons">
<a href="<?php echo PolarisCore::getUrl(array('custompopup' => 'appz/gestion/panels/combat_addennemi/actpane.php'), true, array()); ?>">Ajouter un ennemi</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'combat_distance/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Attaque à distance</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'combat_corpsacorps/actpane.php',  'windowType' => 'jetWindow'), true, array('panel')); ?>">Attaque au corps à corps</a>


</div>

<div class="categorie">Santé</div>
<div class="boutons">
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'blessure/actpane.php', 'windowType' => 'halfJetWindow'), true, array('panel')); ?>">Infliger une blessure</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'addhemorragie/actpane.php'), true, array('panel')); ?>">Ajouter une hémorragie</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'inconscientoui/actpane.php'), true, array('panel')); ?>">Tomber inconscient</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'inconscientnon/actpane.php'), true, array('panel')); ?>">Sortir de l'inconscience</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'fatigueadd/actpane.php'), true, array('panel')); ?>">Fatigue +</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'fatigueremove/actpane.php'), true, array('panel')); ?>">Fatigue -</a>
//<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'jettalent/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Stopper une hémrorragie</a>
//<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'jettalent/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Diminuer une hémorragie</a>




</div>

<div class="categorie">Jets</div>
<div class="boutons">
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'jettalent/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Jet de talent</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'jetcarac/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Jet de caractéristiques</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'perception_ecouter/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Perception : écouter</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'perception_sentir/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Perception : sentir</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'perception_voir/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Perception : voir</a>
//<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'jettalent/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Chuter</a>

</div>


<div class="categorie">Aventure</div>
<div class="boutons">
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'aventure/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Ajouter une entrée au journal</a>
</div>

<div class="categorie">Combat sous-marin</div>
<div class="boutons">
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'sm_detection/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Jet de détection (1)</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'sm_analyse/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Jet d'analyse (2)</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'sm_soltir/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Calcul d'une solution de tir (3)</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'sm_degats/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Infliger des dégats (4)</a>
<a href="<?php echo PolarisCore::getUrl(array('actpane' => 'sm_integrite/actpane.php', 'windowType' => 'jetWindow'), true, array('panel')); ?>">Jet d'intégrité</a>



</div>
