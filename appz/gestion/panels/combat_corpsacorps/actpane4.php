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

$margeReussite = $_GET['margeReussite'];

$modificateurs = ListTools::toArray(ListTools::append($_GET['modificateurs1'], $_GET['modificateurs2']));
$talentName = $attaquant->getTalentNameArmeCorpsACorps();
$talentValue = $attaquant->getTalentValueArmeCorpsACorps();


$onlyClose = true;
?>

<div class="mainTitle">Résultats de l'attaque</div>


<input type="hidden" name="marge" id="marge" value="0">
<input type="hidden" name="valid" value="1">

<div class="smallCol" style="width: 200px;">
    <div class="colTitle">
	Modifications à la marge
    </div>
    
    <table>
        <tr>
            <td>Base</td>
            <td class="rightCell"><?php echo $margeReussite; ?></td>
        </tr>
        <?php
        if($_GET['reussiteCritique'] > 0){
             echo '<tr>';
                echo '<td>Réussite critique</td>';
                echo '<td class="rightCell">+'.$_GET['reussiteCritique'].'</td>';
            echo '</tr>';
            $margeReussite += $_GET['reussiteCritique'];
        }
        if($_GET['parer'] == 1){
            echo '<tr>';
                echo '<td>Parer (marge réussite)</td>';
                echo '<td class="rightCell">-'.$_GET['parerMarge'].'</td>';
            echo '</tr>';
            $margeReussite -= $_GET['parerMarge'];
        }
        if($_GET['esquiver'] == 1){
            $reduction = $_GET['esquiverMarge']-round(($defenseur->getNiveauEsquive()/2));
            echo '<tr>';
                echo '<td>Esquiver ('.$_GET['esquiverMarge'].'-('.$defenseur->getNiveauEsquive().'/2))</td>';
                echo '<td class="rightCell">-'.$reduction.'</td>';
            echo '</tr>';
            $margeReussite -= $reduction;
        }
        ?>
        <tr>
            <td>Final</td>
            <td class="rightCell"><?php echo $margeReussite; ?></td>
        </tr> 
    </table>
    
</div>

<div class="smallCol" style="width: 200px;">
    <div class="colTitle">
	Dégats physiques
    </div>
    
    <table>
        <?php
        $degatsPhys = $attaquant->getArmeCorpsACorpsDegatsPhysiques();
        ?>
        <tr>
            <td>Base (<?php echo $attaquant->getArmeCorpsACorpsName(); ?>)</td>
            <td class="rightCell"><?php echo $degatsPhys; ?></td>
        </tr>
        
 
        <?php if($degatsPhys > 0) { ?>
        
        <?php 
        $bonus = $attaquant->getBonusDegats();
        $degatsPhys += $bonus;
        ?>
        <tr>
            <td>Bonus aux dégats</td>
            <td class="rightCell"><?php if($bonus >= 0){ echo '+'; } echo $bonus; ?></td>
        </tr> 
        <?php
        if($_GET['parer'] == 1){
            $parer = (int)$defenseur->getResArmeCorpsACorps();
            $degatsPhys - $parer;
            echo '<tr>';
                echo '<td>Parer (Resistance de l\'arme)</td>';
                echo '<td class="rightCell">-'.$parer.'</td>';
            echo '</tr>';
        }
        ?>
        
        <?php
            $degatsPhys = $margeReussite*$degatsPhys;
        ?>
        <tr>
            <td>Multiplicateur marge</td>
            <td class="rightCell">x<?php echo $margeReussite; ?></td>
        </tr>
        
        <?php
            $protection = $defenseur->getProtection();
            $degatsPhys -= $protection;
            if($degatsPhys < 0){
                $degatsPhys = 0;
            }
        ?>
        <tr>
            <td>Protection défenseur</td>
            <td class="rightCell">-<?php echo $protection; ?></td>
        </tr>
        
        <?php } ?>
        <tr>
            <td>Total</td>
            <td class="rightCell"><?php echo $degatsPhys; ?></td>
        </tr>
    </table>
    
</div>

<div class="smallCol" style="width: 200px;">
    <div class="colTitle">
	Dégats de choc
    </div>
    
    <table>
        <?php
        $degatsChoc = $attaquant->getArmeCorpsACorpsDegatsChoc();
        ?>
        <tr>
            <td>Base (<?php echo $attaquant->getArmeCorpsACorpsName(); ?>)</td>
            <td class="rightCell"><?php echo $degatsChoc; ?></td>
        </tr>
        
        
        <?php if($degatsChoc > 0) { ?>
        <?php 
        $bonus = $attaquant->getBonusDegats();
        $degatsChoc += $bonus;
        ?>
        <tr>
            <td>Bonus aux dégats</td>
            <td class="rightCell"><?php if($bonus >= 0){ echo '+'; } echo $bonus; ?></td>
        </tr> 
        <?php
        if($_GET['parer'] == 1){
            $parer = (int)$defenseur->getResArmeCorpsACorps();
            $degatsPhys - $parer;
            echo '<tr>';
                echo '<td>Parer (Resistance de l\'arme)</td>';
                echo '<td class="rightCell">-'.$parer.'</td>';
            echo '</tr>';
        }
        ?>
        
        <?php
            $degatsChoc = $margeReussite*$degatsChoc;
        ?>
        <tr>
            <td>Multiplicateur marge</td>
            <td class="rightCell">x<?php echo $margeReussite; ?></td>
        </tr>
        
        <?php
            $protection = $defenseur->getProtection();
            $degatsChoc -= $protection;
            if($degatsChoc < 0){
                $degatsChoc = 0;
            }
        ?>
        <tr>
            <td>Protection défenseur</td>
            <td class="rightCell">-<?php echo $protection; ?></td>
        </tr>
            
        <?php } ?>
        <tr>
            <td>Total</td>
            <td class="rightCell"><?php echo $degatsChoc; ?></td>
        </tr>
        
        
    </table>
    
</div>


<div class="smallCol" style="width: 200px;">
    <div class="colTitle">
	Dégats infligés
    </div>
    
    <?php
    $resultat = array();
    $blessures = array();
    $jets = array();
    if($degatsChoc > 0 || $degatsPhys > 0){

        
	$defenseur->resolveDegatsOnProtection($degatsChoc);
	$defenseur->resolveDegatsOnProtection($degatsPhys);
            
	$r = $defenseur->addBlessure($degatsPhys, $degatsChoc);
	$blessures = ArrayTools::merge($blessures, $r['blessures']);
	$jets = ArrayTools::merge($jets, $r['jets']);
        
        
    }
    

    
    ?>
    
    <div class="editItem">
	<div class="label">Seuils de blessure</div>
	<div class="form">
            <table>
                <tr>
                    <td>Inconscience</td>
                    <td><?php echo $defenseur->getSeuil('INCONSCIENCE'); ?></td>
                </tr>
                <tr>
                    <td>Blessure léégère</td>
                    <td><?php echo $defenseur->getSeuil('LEGERE'); ?></td>
                </tr>
                <tr>
                    <td>Blessure grave</td>
                    <td><?php echo $defenseur->getSeuil('GRAVE'); ?></td>
                </tr>
                <tr>
                    <td>Blessure critique</td>
                    <td><?php echo $defenseur->getSeuil('CRITIQUE'); ?></td>
                </tr>
                <tr>
                    <td>Blessure fatale</td>
                    <td><?php echo $defenseur->getSeuil('FATAL'); ?></td>
                </tr>
                <tr>
                    <td>Mort</td>
                    <td><?php echo $defenseur->getSeuil('MORT'); ?></td>
                </tr>
            </table>
	</div>
    </div>
    
    <div class="editItem">
	<div class="label">Blessures infligées</div>
	<div class="form">
	    <?php
            if(count($blessures) == 0){
                echo 'Aucune';
            }
	    foreach ($blessures AS $b){
		echo '<div>'.$b.'</div>';
	    }
	    ?>
	</div>
    </div>
    
    <div class="editItem">
	<div class="label">Jets necessaires</div>
	<div class="form">
	    <?php
            if(count($jets) == 0){
                echo 'Aucun';
            }
	    foreach ($jets AS $j){
		echo '<div>'.$j.'</div>';
	    }
	    ?>
	</div>
    </div>
    
    
</div>