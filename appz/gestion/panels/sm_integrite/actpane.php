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

<div class="mainTitle">Jet d'intégrité</div>


<div class="smallCol" style="width: 200px;">
    
    <div class="editItem">
	<div class="label">Difficulté</div>
	<div class="form">
	    <input type="text" name="difficulte" value="0">
	</div>
    </div>
    
    <div class="editItem">
	<div class="label">Intégrité</div>
	<div class="form">
	    <input type="text" name="integrite" value="0">
	</div>
    </div>
    
</div>



<?php
}else{
    $onlyClose = true;

    $diff = $_POST['difficulte']-$_POST['integrite'];
    if($diff < 0){
	$diff = 0;
    }

?>

<div class="mainTitle">Jet d'integrité : resultat</div>

<input type="hidden" name="marge" value="0" id="marge">
<input type="hidden" name="degats" id="degats" value="<?php echo $_POST['degats']; ?>">
<input type="hidden" name="blindage" id="blindage" value="<?php echo $_POST['blindage']; ?>">
<div class="smallCol" style="width: 200px;">
    <div class="editItem">
    <div class="label">Base de calcul</div>
    <div class="form">
	<table>
	    <tr>
		<td>Pourcentage de chance</td>
		<td><?php echo 99 - ($diff*5); ?>%</td>
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
	    echo Paliers::renderPalierColumn(99 - ($diff*5));
	    ?>
	</div>
    </div>
</div>
<?php
}
?>
  

