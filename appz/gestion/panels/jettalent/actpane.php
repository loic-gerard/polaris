<?php

use polarisapi\ui\utils\EntiteSelect;
use polarisapi\ui\utils\AttributSelect;

$joueur = new EntiteSelect('PJ', 'joueur', 'NOM', null, 'onChange="javascript:calculateJet();"');

$attribut = new AttributSelect('PJ', 'attribut', null, null, null, 1, 'onChange="javascript:calculateJet();"', array('TALENTSTALENTS_PHYSIQUES', 'TALENTS_COMBAT', 'TALENTS_SOCIAUX', 'TALENTS_COMMERCIAUX', 'TALENTS_ARTISANAUX', 'TALENTS_CONNAISSANCES', 'TALENTS_ARTISTIQUES', 'TALENTS_MENTAUX', 'TALENTS_NAVIGATION', 'TALENTS_INVESTIGATION', 'TALENTS_MEDICAUX'));

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
        <select id="intensite" name="intensite" onChange="javascript:calculateJet();">
            <option value="0">SANS DIFFICULTE</option>
            <?php
            for($i = 1; $i <= 50; $i++){
                echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>
        </select>
    </div>
</div>
</div>
<div class="rightPane" id="resultatCalcul"></div>

<?php } ?>
