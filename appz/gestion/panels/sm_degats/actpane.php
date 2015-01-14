<?php

use polarisapi\ui\utils\EntiteSelect;
use polarisapi\ui\utils\AttributSelect;
use polarisapi\data\View;
use polarisapi\ui\utils\ModificateurSelect;
use jin\lang\ListTools;
use jin\lang\ArrayTools;
use polarisapi\data\attribut\Attribut;
use polarisapi\data\Paliers;




?>

<input type="hidden" name="valid" value="1">

<?php



if(!isset($_POST['valid'])){
?>

<div class="mainTitle">Calcul des dégats : paramètres</div>


<div class="smallCol" style="width: 200px;">
    



    <div class="editItem">
	<div class="label">Palier torpille ou attaque</div>
	<div class="form">
	    <input type="text" name="palier" value="0">
	</div>
    </div>
    
    <div class="editItem">
	<div class="label">Degats</div>
	<div class="form">
	    <input type="text" name="degats" value="0">
	</div>
    </div>
    
    <div class="editItem">
	<div class="label">Blindage adverse</div>
	<div class="form">
	    <input type="text" name="blindage" value="0">
	</div>
    </div>
</div>

<div class="smallCol" style="width: 200px;">
<div class="editItem">
    <div class="label">Modificateur libre</div>
    <div class="form">
        <input type="text" name="modificateur" value="0">
    </div>
</div>
</div>



<?php
}else if(!isset($_POST['marge'])){
    $onlyClose = true;
    $total = $_POST['modificateur'];
    
    $basePorcent = $_POST['palier']*10;
?>

<div class="mainTitle">Calcul des dégats : jet</div>

<input type="hidden" name="marge" value="0" id="marge">
<input type="hidden" name="degats" id="degats" value="<?php echo $_POST['degats']; ?>">
<input type="hidden" name="blindage" id="blindage" value="<?php echo $_POST['blindage']; ?>">
<div class="smallCol" style="width: 200px;">
    <div class="editItem">
    <div class="label">Base de calcul</div>
    <div class="form">
	<table>
	    <tr>
		<td>Pourcentage de base</td>
		<td><?php echo $basePorcent; ?>%</td>
	    </tr>
	    <tr>
		<td>Modificateurs</td>
		<td><?php echo $total; ?>%</td>
	    </tr>
	    <tr>
		<td>Total</td>
		<td><?php echo $basePorcent+$total; ?>%</td>
	    </tr>
	</table>
    </div>
</div>
</div>

<div class="smallCol" style="width: 200px;">
    <div class="editItem">
	<div class="label">Paliers</div>
	<div class="form">


	    <?php
	    echo Paliers::renderPalierColumn($basePorcent+$total, 'document.getElementById(\'marge\').value=\'%marge%\';document.getElementById(\'modificateurForm\').submit();');
	    ?>
	</div>
    </div>
</div>
<?php
}else{
    
    $onlyClose = true;
?>
    
<div class="mainTitle">Calcul des dégats : résultats</div>
<div class="smallCol" style="width: 200px;">
    <div class="editItem">
    <div class="label">Base de calcul</div>
    <div class="form">
	<table>
	    <tr>
		<td>Dégats de base</td>
		<td><?php echo $_POST['degats']; ?></td>
	    </tr>
	    <tr>
		<td>Modificateurs</td>
		<td>x<?php echo $_POST['marge']; ?></td>
	    </tr>
	    <tr>
		<td>Total</td>
		<td><?php echo ($_POST['degats']*$_POST['marge']) ?></td>
	    </tr>
	    <tr>
		<td>Blindage</td>
		<td>-<?php echo $_POST['blindage']; ?></td>
	    </tr>
	    <?php
	    $restant = ($_POST['degats']*$_POST['marge'])-$_POST['blindage'];
	    if($restant < 0){
		$restant = 0;
	    }
	    ?>
	    <tr>
		<td>Restant</td>
		<td><?php echo $restant; ?></td>
	    </tr>
	</table>
    </div>
</div>
</div>

<div class="smallCol" style="width: 200px;">
    <div class="editItem">
    <div class="label">Dégats</div>
    <div class="form">
	<?php

	if($restant > 0){
	    echo floor($restant/$_POST['blindage']).' cercles de blindage';
	}else{
	    echo '<b>Aucune</b>';
	}
	
	?>
    </div>
</div>
</div>
<?php
}
?>

