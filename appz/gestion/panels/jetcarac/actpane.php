<?php

use polarisapi\ui\utils\EntiteSelect;
use polarisapi\ui\utils\AttributSelect;

$joueur = new EntiteSelect('PJ', 'joueur', 'NOM', null, '');
$attributPJ = new AttributSelect('PJ', 'attributpj', null, null, null, 1, '', array('CARACTERISTIQUES', 'CARACSEC'));
$attributPNJ = new AttributSelect('PNJ', 'attributpnj', null, null, null, 1, '', array());
$pnj = new EntiteSelect('PNJ', 'pnj', 'PNJ_NOM');

?>


<?php 
if($confirm){
?>

<?php
}else{
?>

<div class="leftPane">
<input type="hidden" name="valid" value="1">

<div class="editItem">
    <div class="label">Cible</div>
    <div class="form">
        <input onclick="javascript:setPj();document.getElementById('talent_PJ').style.display='';document.getElementById('talent_PNJ').style.display='none';" id="type_pj" type="radio" name="target" value="PJ" checked="checked">PJ&nbsp;
	<input onclick="javascript:setPnj();document.getElementById('talent_PJ').style.display='none';document.getElementById('talent_PNJ').style.display='';" id="type_pnj" type="radio" name="target" value="PNJ">PNJ&nbsp;
    </div>
</div>

<div class="editItem" id="panel_PJ">
    <div class="label">Joueur</div>
    <div class="form">
        <?php echo $joueur->build(); ?>
    </div>
</div>

<div class="editItem" id="panel_PNJ" style="display: none;">
    <div class="label">PNJ</div>
    <div class="form">
        <?php echo $pnj->build(); ?>
    </div>
</div>

<div class="editItem" id="talent_PJ">
    <div class="label">Talent</div>
    <div class="form">
        <?php echo $attributPJ->build(); ?>
    </div>
</div>

<div class="editItem" id="talent_PNJ" style="display:none;">
    <div class="label">Talent</div>
    <div class="form">
        <?php echo $attributPNJ->build(); ?>
    </div>
</div>

<div class="editItem">
    <div class="label">Difficulté / Intensité</div>
    <div class="form">
        <select id="intensite" name="intensite">
            <option value="0">SANS DIFFICULTE</option>
            <?php
            for($i = 1; $i <= 50; $i++){
                echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>
        </select>
    </div>
</div>


<div class="editItem">
    <div class="label">Duel : marge adverse cumulée</div>
    <div class="form">
        <input type="text" name="margeadv" id="margeadv" value="0">
    </div>
</div>
<br><br>
<a href="javascript:calculateJetCarac();" class="smallBlueButton">Calculer</a>

</div>




<div class="rightPane" id="resultatCalcul"></div>

<?php } ?>
