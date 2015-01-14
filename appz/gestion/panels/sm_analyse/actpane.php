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



<?php
if(!isset($_POST['valid'])){
?>

<div class="mainTitle">Jet d'analyse</div>

<div>
    <b>Remarques :</b><br>
    Il faut un seul jet d'analyse réussi pour calculer une solution de tir avec un sonar actif.<br>
    Il faut 5 jets d'analyses consécutifs pour calculer une solution de tir avec un sonar passif.<br><br>
</div>

<div class="smallCol" style="width: 200px;">
    <input type="hidden" name="valid" value="1">

    <div class="editItem">
	<div class="label">Palier de l'analyseur</div>
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





<?php
}else{
    $onlyClose = true;
    
    $total = $_POST['modificateur'];
    
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


<div class="smallCol" style="width: 300px;">
    <div class="editItem">
	<div class="label">Informations en fonction de la marge</div>
	<div class="form">
	    <table>
		<tr class="header">
		    <td>Marge</td>
		    <td>Informations</td>
		</tr>
		<tr>
		    <td>1</td>
		    <td>Direction du contact</td>
		</tr>
		<tr>
		    <td>2</td>
		    <td>Portée du contact</td>
		</tr>
		<tr>
		    <td>3</td>
		    <td>Profondeur du contact</td>
		</tr>
		<tr>
		    <td>5</td>
		    <td>Masse du contact</td>
		</tr>
		<tr>
		    <td>5</td>
		    <td>Taille du contact</td>
		</tr>
		<tr>
		    <td>8</td>
		    <td>Vitesse du contact</td>
		</tr>
		<tr>
		    <td>8</td>
		    <td>Nature du contact (artificiel ou pas)</td>
		</tr>
		<tr>
		    <td>6</td>
		    <td>Mode de propulsion</td>
		</tr>
		<tr>
		    <td>2</td>
		    <td>Classe du contact</td>
		</tr>
		<tr>
		    <td>10</td>
		    <td>Type exact</td>
		</tr>
		<tr>
		    <td>10</td>
		    <td>Statut. (torpilles armées par ex.)</td>
		</tr>
		<tr>
		    <td>8</td>
		    <td>Autres informations</td>
		</tr>
	    </table>
	</div>
    </div>
</div>

<?php
}
?>

