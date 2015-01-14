<?php

use polarisapi\ui\utils\EntiteSelect;
use polarisapi\ui\utils\ModificateurSelect;

$joueur_attaquant = new EntiteSelect('PJ', 'joueurAttaquant', 'NOM');
$pnj_attaquant = new EntiteSelect('PNJ', 'pnjAttaquant', 'PNJ_NOM');
$joueur_defenseur = new EntiteSelect('PJ', 'joueurDefenseur', 'NOM');
$pnj_defenseur = new EntiteSelect('PNJ', 'pnjDefenseur', 'PNJ_NOM');


$combat = new ModificateurSelect('COMBAT', '', true, 'modificateurs1');
$combat2 = new ModificateurSelect('COMBAT2', '', true, 'modificateurs2');
?>


<?php 
if($confirm){
?>



<?php
}else{
?>

<input type="hidden" name="valid" value="1">

<div class="mainTitle">Contexte</div>

<div class="smallCol" style="width: 200px;">
    <div class="colTitle">Attaquant</div>
    
    <div class="editItem">
	<div class="label">Type</div>
	<div class="form">
	    <input onclick="javascript:setPjAttaquant();" type="radio" name="typeAttaquant" value="PJ" checked="checked">PJ&nbsp;
	    <input onclick="javascript:setPnjAttaquant();" type="radio" name="typeAttaquant" value="PNJ">PNJ&nbsp;
	</div>
    </div>

    <div class="editItem" id="panel_attaquant_PJ">
	<div class="label">Joueur</div>
	<div class="form">
	    <?php echo $joueur_attaquant->build(); ?>
	</div>
    </div>

    <div class="editItem" id="panel_attaquant_PNJ" style="display: none;">
	<div class="label">PNJ</div>
	<div class="form">
	    <?php echo $pnj_attaquant->build(); ?>
	</div>
    </div>
</div>

<div class="smallCol" style="width: 200px;">
    <div class="colTitle">Défenseur</div>
    
    <div class="editItem">
	<div class="label">Type</div>
	<div class="form">
	    <input onclick="javascript:setPjDefenseur();" type="radio" name="typeDefenseur" value="PJ" checked="checked">PJ&nbsp;
	    <input onclick="javascript:setPnjDefenseur();" type="radio" name="typeDefenseur" value="PNJ">PNJ&nbsp;
	</div>
    </div>

    <div class="editItem" id="panel_defenseur_PJ">
	<div class="label">Joueur</div>
	<div class="form">
	    <?php echo $joueur_defenseur->build(); ?>
	</div>
    </div>

    <div class="editItem" id="panel_defenseur_PNJ" style="display: none;">
	<div class="label">PNJ</div>
	<div class="form">
	    <?php echo $pnj_defenseur->build(); ?>
	</div>
    </div>
</div>

<div class="smallCol" style="width: 300px;">
    <div class="colTitle">Modificateurs (position)</div>
     <?php echo $combat->build(); ?>
</div>

<div class="smallCol" style="width: 300px;">
    <div class="colTitle">Modificateurs (vision)</div>
     <?php echo $combat2->build(); ?>
</div>






<?php } ?>
