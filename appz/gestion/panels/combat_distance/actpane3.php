<?php

use polarisapi\objects\Player;
use polarisapi\objects\Pnj;
use jin\lang\ListTools;
use jin\lang\ArrayTools;
use polarisapi\data\attribut\Attribut;
use polarisapi\data\Paliers;

if($_GET['typeAttaquant'] == 'PJ'){
    $attaquant = new Player($_GET['idAttaquant']);
}else{
    $attaquant = new Pnj($_GET['idAttaquant']);
}

if($_GET['typeDefenseur'] == 'PJ'){
    $defenseur = new Player($_GET['idDefenseur']);
}else{
    $defenseur = new Pnj($_GET['idDefenseur']);
}

$modificateurs = ListTools::toArray(ListTools::append($_GET['modificateurs1'], $_GET['modificateurs2']));
$talentName = $attaquant->getTalentNameArmeDistance();
$talentValue = $attaquant->getTalentValueArmeDistance();

?>

<input type="hidden" name="marge" id="marge" value="0">
<input type="hidden" name="valid" value="1">

<div class="smallCol" style="width: 200px;">
    <div class="colTitle">
	Modificateurs au % de toucher
    </div>
    
    <div class="editItem">
	<div class="label">Base</div>
	<div class="form">
	    <table>
		<tr>
		    <td><?php echo $talentName; ?></td>
		    <td class="rightCell"><?php echo $talentValue; ?>%</td>
		</tr>
	    </table>
	</div>
    </div>
    
    <div class="editItem">
	<div class="label">Modificateurs environnement</div>
	<div class="form">
	    <table>
	    <?php
	    
	    if(count($modificateurs) == 0){
		echo 'Aucun';
	    }
	    
	    $totalModif = 0;
	    foreach($modificateurs AS $m){
		$a_label = Attribut::getAttribut($m, 'MODIFICATEUR_LABEL');
		$a_mod = Attribut::getAttribut($m, 'MODIFICATEUR_VALUE');
		echo '<tr>';
		echo '<td>'.$a_label->getFinalValue().' ('.$a_mod->getFinalValue().'%)<td>';
		echo '</tr>';
		$totalModif += $a_mod->getFinalValue();
	    }
	    
	    $totalPorcent = $talentValue - $totalModif;
	    if($totalPorcent <= 1){
		$totalPorcent = 1;
	    }
	    ?>
	    </table>
	</div>
    </div>
    
    <div class="editItem">
	<div class="label">Final</div>
	<div class="form">
	    <table>
		<tr>
		    <td>Total</td>
		    <td class="rightCell"><?php echo $totalPorcent; ?>%</td>
		</tr>
	    </table>
	</div>
    </div>
    
</div>

<div class="smallCol" style="width: 200px;">
    <div class="colTitle">
	Jet de <?php echo $talentName; ?>
    </div>
    
    <?php
    echo Paliers::renderPalierColumn($totalPorcent, 'document.getElementById(\'marge\').value=\'%marge%\';document.getElementById(\'modificateurForm\').submit();');
    ?>
    
</div>