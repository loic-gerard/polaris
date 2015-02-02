<?php
if(isset($_GET['actpane'])){
?>

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
        if(isset($onlyClose) || $confirm){
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
	exit;

}
