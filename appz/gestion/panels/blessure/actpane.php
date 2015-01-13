<?php

use polarisapi\ui\utils\EntiteSelect;

$joueur = new EntiteSelect('PJ', 'joueur', 'NOM');
$pnj = new EntiteSelect('PNJ', 'pnj', 'PNJ_NOM');

?>


<?php 
if($confirm){
?>

<table>
    <tr>
        <td>Blessures infligées : </td>
        <td class="leftCell">
	    
	    <?php
	    foreach ($resultat['blessures'] AS $b){
		echo '<div>'.$b.'</div>';
	    }
	    ?>
	</td>
    </tr>
    <tr>
	<td>Jets nécessaires : </td>
        <td class="leftCell">
	    
	    <?php
	    foreach ($resultat['jets'] AS $b){
		echo '<div>'.$b.'</div>';
	    }
	    ?>
	</td>
    </tr>
</table>

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
    <div class="label">Blessures physiques</div>
    <div class="form">
        <input type="text" name="blessure_physique" value="0">
    </div>
</div>

<div class="editItem">
    <div class="label">Blessures de choc</div>
    <div class="form">
        <input type="text" name="blessure_choc" value="0">
    </div>
</div>

<?php } ?>
