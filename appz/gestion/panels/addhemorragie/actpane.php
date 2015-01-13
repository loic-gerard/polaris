<?php

use polarisapi\ui\utils\EntiteSelect;

$joueur = new EntiteSelect('PJ', 'joueur', 'NOM');

?>


<?php 
if($confirm){
?>

<table>
    <tr>
        <td>Type d'hémorragie : </td>
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
    <div class="label">Type d'hémorragie</div>
    <div class="form">
        <select name="type">
            <option value="LEGERE">Légère (due à une blessure grave)</option>
            <option value="GRAVE">Grave (due à une blessure critique)</option>
            <option value="LEGERE">Critique (due à une blessure fatale)</option>
        </select>
    </div>
</div>

<?php } ?>
