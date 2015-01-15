<?php

use polarisapi\objects\Player;
use polarisapi\objects\Pnj;
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

$resParer = $defenseur->getResArmeCorpsACorps();
$jetParer = $defenseur->getParerArmeCorpsACorps();
$jetEsquive = $defenseur->getEsquiveArmeCorpsACorps();

?>

<input type="hidden" name="marge" id="marge" value="0">
<input type="hidden" name="valid" value="1">

<?php
if(!$attaquant->isArmeCorpsACorps()){

    echo '<div class="mainTitle">Erreur</div>';
    echo '<div class="smallCol" style="width: 200px;">';
    echo '<div class="colTitle">';
    echo 'Pas d\'arme de corps à corps';
    echo '</div>';
    echo '</div>';
}else if($attaquant->getResArmeCorpsACorps() == 0){    
    echo '<div class="mainTitle">Erreur</div>';
    echo '<div class="smallCol" style="width: 200px;">';
    echo '<div class="colTitle">';
    echo 'Resistance de l\'arme épuisée';
    echo '</div>';
    echo '</div>';
}else{
?>

<div class="mainTitle">Réactions du défenseur</div>

<div class="smallCol" style="width: 200px;">
    <div class="colTitle">
	Parer l'attaque
    </div>
    
    <div class="editItem">
	<div class="label">Parer</div>
	<div class="form">
	    <input type="radio" name="parer" value="0" checked="checked">NON&nbsp;
	    <input type="radio" name="parer" value="1">OUI&nbsp;
	</div>
    </div>
    
    <div class="editItem">
	<div class="label">Parer avec</div>
	<div class="form">
	    <div><input type="radio" name="parer_objet" checked="checked" value="0">Le corps (Res: 0)</div>
	    <div><input type="radio" name="parer_objet" value="<?php echo $resParer; ?>">L'arme utilisée (Res: <?php echo $resParer;  ?>)</div>
	</div>
    </div>
    
    <div class="editItem">
	<div class="label">Jet</div>
	<div class="form">
	    <?php
	    echo Paliers::renderPalierColumn($jetParer, null, 'margeParer');
	    echo '<br><br><a class="actBlueButton" href="javascript:addProgressionPoint(\''.$_GET['idDefenseur'].'\',\'TALENT\',\''.$defenseur->getTalentCodeArmeCorpsACorps().'\');">Réussite ou échec critique</a>';
	    ?>
	</div>
    </div>
    
</div>


<div class="smallCol" style="width: 200px;">
    <div class="colTitle">
	Esquiver l'attaque
    </div>
    
     <div class="editItem" id="panel_attaquant_PJ">
	<div class="label">Esquiver</div>
	<div class="form">
	    <input type="radio" name="esquiver" value="0" checked="checked">NON&nbsp;
	    <input type="radio" name="esquiver" value="1">OUI&nbsp;
	</div>
    </div>
    
    <div class="editItem">
	<div class="label">Jet</div>
	<div class="form">
	    <?php
	    echo Paliers::renderPalierColumn($jetEsquive, null, 'margeEsquiver');
	    echo '<br><br><a class="actBlueButton" href="javascript:addProgressionPoint(\''.$_GET['idDefenseur'].'\',\'TALENT\',\'TALENT_ESQUIVE\');">Réussite ou échec critique</a>';
	    ?>
	</div>
    </div>
</div>

<?php
}
?>