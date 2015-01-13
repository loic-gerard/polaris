<?php

use polarisapi\ui\utils\EntiteSelect;
use polarisapi\ui\utils\AttributSelect;

$joueur = new EntiteSelect('PJ', 'joueur', 'NOM', null, 'onChange="javascript:calculateJetCarac();"');
$attribut = new AttributSelect('PJ', 'attribut', null, null, null, 1, 'onChange="javascript:calculateJetCarac();"', array('CARACTERISTIQUES'));

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
    <div class="label">Joueur</div>
    <div class="form">
        <?php echo $joueur->build(); ?>
    </div>
</div>

<div class="editItem">
    <div class="label">Talent</div>
    <div class="form">
        <?php echo $attribut->build(); ?>
    </div>
</div>

<div class="editItem">
    <div class="label">Difficulté / Intensité</div>
    <div class="form">
        <select id="intensite" name="intensite" onChange="javascript:calculateJetCarac();">
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
        <input type="text" onkeyup="javascript:calculateJetCarac();" name="margeadv" id="margeadv" value="0">
    </div>
</div>
</div>
<div class="rightPane" id="resultatCalcul"></div>

<?php } ?>
