<?php

use polarisapi\ui\utils\EntiteSelect;
use polarisapi\ui\utils\AttributSelect;
use polarisapi\data\View;
use polarisapi\ui\utils\ModificateurSelect;

$msd = new ModificateurSelect('PERCEPTION', 'onChange="javascript:calculateJetPerceptionSentir();"');

$joueur = new EntiteSelect('PJ', 'joueur', 'NOM', null, 'onChange="javascript:calculateJetPerceptionSentir();"');

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
        <input type="text" name="difficulte" id="difficulte" value="0" onkeyup="javascript:calculateJetPerceptionSentir();">
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


<div class="rightPane" id="resultatCalcul"></div>

<?php } ?>