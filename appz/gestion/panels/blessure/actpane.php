<?php

use polarisapi\ui\utils\EntiteSelect;

$joueur = new EntiteSelect('PJ', 'joueur', 'NOM');

?>


<?php 
if($confirm){
?>

<table>
    <tr>
        <td>Blessure infligée : </td>
        <td><?php echo $resultat['typeblessure']; ?></td>
    </tr>
</table>

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

<div class="editItem">
    <div class="label">Blessures infligées</div>
    <div class="form">
        <input type="text" name="blessure" value="0">
    </div>
</div>

<?php } ?>
