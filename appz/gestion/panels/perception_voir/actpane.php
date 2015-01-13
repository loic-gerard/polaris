<?php

use polarisapi\ui\utils\EntiteSelect;
use polarisapi\ui\utils\AttributSelect;
use polarisapi\data\View;
use polarisapi\ui\utils\ModificateurSelect;

$ms = new ModificateurSelect('VOIR', 'onChange="javascript:calculateJetPerceptionVoir();"');
$msd = new ModificateurSelect('PERCEPTION', 'onChange="javascript:calculateJetPerceptionVoir();"');

$joueur = new EntiteSelect('PJ', 'joueur', 'NOM', null, 'onChange="javascript:calculateJetPerceptionVoir();"');

?>


<?php 
if($confirm){
?>

<?php
}else{
?>

<div class="leftPane" style="width: 200px;">
<input type="hidden" name="valid" value="1">

<div class="editItem">
    <div class="label">Joueur</div>
    <div class="form">
        <?php echo $joueur->build(); ?>
    </div>
</div>

<div class="editItem">
    <div class="label">Difficulté supplémentaire</div>
    <div class="form">
        <input type="text" name="difficulte" id="difficulte" value="0" onkeyup="javascript:calculateJetPerceptionVoir();">
    </div>
</div>





</div>

<div class="smallCol" style="width: 200px;">
<div class="editItem">
    <div class="label">Difficulté de base</div>
    <div class="form">
        <?php echo $msd->build(); ?>
    </div>
</div>
</div>

<div class="smallCol" style="width: 200px;">
<div class="editItem">
    <div class="label">Modificateurs</div>
    <div class="form">
        <?php echo $ms->build(); ?>
    </div>
</div>
</div>

<div class="rightPane" id="resultatCalcul"></div>

<?php } ?>
