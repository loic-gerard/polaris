<?php

use polarisapi\ui\utils\EntiteSelect;

$joueur = new EntiteSelect('PJ', 'joueur', 'NOM');

?>

<?php 
if($confirm){
?>


<?php
}else{
?>

<input type="hidden" name="valid" value="1">

<div class="editItem">
    <div class="label">Joueur</div>
    <div class="form">
        <?php echo $joueur->build(); ?>
    </div>
</div>

<?php } ?>
