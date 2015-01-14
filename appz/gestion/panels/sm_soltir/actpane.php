<?php

use polarisapi\ui\utils\EntiteSelect;
use polarisapi\ui\utils\AttributSelect;
use polarisapi\data\View;
use polarisapi\ui\utils\ModificateurSelect;
use jin\lang\ListTools;
use jin\lang\ArrayTools;
use polarisapi\data\attribut\Attribut;
use polarisapi\data\Paliers;

$ms = new ModificateurSelect('SOLTIR', '', true, 'modificateurs1');




?>



<?php
if(!isset($_POST['valid'])){
?>

<div class="mainTitle">Jet de calcul d'une solution de tir</div>


<div class="smallCol" style="width: 200px;">
    <input type="hidden" name="valid" value="1">

    <div class="editItem">
	<div class="label">Type de sonar</div>
	<div class="form">
	    <input type="radio" name="typesonar" value="actif" checked="checked">Actif&nbsp;
	    <input type="radio" name="typesonar" value="passif">Passif&nbsp;
	</div>
    </div>

    <div class="editItem">
	<div class="label">Palier du calculateur de tir</div>
	<div class="form">
	    <input type="text" name="palier" value="0">
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

<div class="smallCol" style="width: 200px;">
<div class="editItem">
    <div class="label">Modificateurs</div>
    <div class="form">
        <?php echo $ms->build(); ?>
    </div>
</div>
</div>




<?php
}else{
    $onlyClose = true;
    
    $modificateurs1 = array();
    if(isset($_POST['modificateurs1'])){
	$modificateurs1 = $_POST['modificateurs1'];
    }
    
    
    $modificateurs = $modificateurs1;
    

    $total = 0;
    foreach($modificateurs AS $m){
	$a_mod = Attribut::getAttribut($m, 'MODIFICATEUR_VALUE');
	$bv = $a_mod->getFinalValue();
	if($_POST['typesonar'] == 'actif'){
	    $v = (int)  ListTools::ListGetAt($bv, 0, '/');
	}else{
	    $v = (int)  ListTools::ListGetAt($bv, 1, '/');
	}
	$total += $v;
    }
    $total += $_POST['modificateur'];
    
    $basePorcent = $_POST['palier']*10;
?>

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
	    echo Paliers::renderPalierColumn($basePorcent+$total);
	    ?>
	</div>
    </div>
</div>

    
 

<?php
}
?>

