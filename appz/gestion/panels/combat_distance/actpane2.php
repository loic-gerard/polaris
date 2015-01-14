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

$resParer = $defenseur->getResArmeDistance();
$jetParer = $defenseur->getParerArmeDistance();
$jetEsquive = $defenseur->getEsquiveArmeDistance();

?>

<input type="hidden" name="marge" id="marge" value="0">
<input type="hidden" name="valid" value="1">

<?php
if(!$attaquant->isArmeDistance()){

    echo '<div class="mainTitle">Erreur</div>';
    echo '<div class="smallCol" style="width: 200px;">';
    echo '<div class="colTitle">';
    echo 'Pas d\'arme à distance';
    echo '</div>';
    echo '</div>';
}else if($attaquant->getArmeDistanceMunitions() == 0){
    echo '<div class="mainTitle">Erreur</div>';
    echo '<div class="smallCol" style="width: 200px;">';
    echo '<div class="colTitle">';
    echo 'Plus de munitions';
    echo '</div>';
    echo '</div>';
}else if($attaquant->getResArmeDistance() == 0){    
    echo '<div class="mainTitle">Erreur</div>';
    echo '<div class="smallCol" style="width: 200px;">';
    echo '<div class="colTitle">';
    echo 'Resistance de l\'arme épuisée';
    echo '</div>';
    echo '</div>';
}else{
?>

<div class="mainTitle">Portée et réactions du défenseur</div>

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
	    ?>
	</div>
    </div>
</div>

<div class="smallCol" style="width: 200px;">
    <div class="colTitle">
	Portée
    </div>
    
    <table>
    <?php
    $portees = $attaquant->getArmeDistancePortees();
    $i = 0;
    foreach($portees AS $p){
        $checked = '';
        if($i==1){
            $checked = 'checked="checked"';
        }
        echo '<tr>';
        echo '<td width=10><input type="radio" name="portee" value="'.$i.'" '.$checked.'"></td>';
        echo '<td class="normalCell leftCell">'.$p.'</td>';
        echo '</tr>';
        $i++;
    }
    ?>
        
    </table>
</div>

<?php
}
?>