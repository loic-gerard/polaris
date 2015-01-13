<?php
use \PolarisCore;
use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\data\attribut\Attribut;
use polarisapi\objects\Player;
use polarisapi\data\Entite;

$confirm = false;

//Ajout blessure
if(isset($_POST['valid']) && $_GET['actpane'] == 'blessure/actpane.php'){
    $player = new Player($_POST['joueur']);
    $resultat = $player->addBlessure($_POST['blessure']);
    $confirm = true;
}

//Ajout journal
if(isset($_POST['valid']) && $_GET['actpane'] == 'aventure/actpane.php'){
    $data = array();
    $now = new \DateTime;
    $data['JOURNAL_TEXTE'] = $_POST['journal'];
    $data['JOURNAL_DATE'] = $now->format('d/m/Y');
    Entite::addEntite('JOURNAL', $data);
    
    header('Location: '.PolarisCore::getUrl(array(), true, array('actpane')));
}

$windowType = "attributModifierWindow";
if(isset($_GET['windowType'])){
    $windowType = $_GET['windowType'];
}


if(isset($_GET['actpane'])){
?>

<div id="attributModifierMask"></div>
<div id="<?php echo $windowType; ?>">
    <div class="content">
        <form method="POST" action="" id="modificateurForm">
            <?php
            include 'panels/'.$_GET['actpane'];
            ?>
        </form>
    </div>

    <div class="barreValid">
        <?php 
        if($confirm){
        ?>
        <a href="<?php echo PolarisCore::getUrl(array(), true, array('actpane')); ?>" class="greenButton">Fermer</a>
        <?php
        }else{
        ?>
        <a href="javascript:document.getElementById('modificateurForm').submit();" class="greenButton">Valider</a>
        <a href="<?php echo PolarisCore::getUrl(array(), true, array('actpane')); ?>" class="redButton">Annuler</a>
        <?php
        }
        ?>
            
    </div>
</div>

<?php
}
?>