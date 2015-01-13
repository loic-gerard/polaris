<?php

use polarisapi\ui\utils\EntiteSelect;

$joueur = new EntiteSelect('PJ', 'joueur', 'NOM');
$pnj = new EntiteSelect('PNJ', 'pnj', 'PNJ_NOM');

?>


<?php 
if($confirm){
?>



<?php
}else{
?>

<input type="hidden" name="valid" value="1">

<div class="editItem">
    <div class="label">Cible</div>
    <div class="form">
        <input onclick="javascript:setPj();" type="radio" name="target" value="PJ" checked="checked">PJ&nbsp;
	<input onclick="javascript:setPnj();" type="radio" name="target" value="PNJ">PNJ&nbsp;
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

<div class="editItem">
    <div class="label">Type d'hémorragie</div>
    <div class="form">
        <select name="typeHemorragie">
            <option value="LEGERE">Légère (due à une blessure grave)</option>
            <option value="GRAVE">Grave (due à une blessure critique)</option>
            <option value="LEGERE">Critique (due à une blessure fatale)</option>
        </select>
    </div>
</div>

<?php } ?>
