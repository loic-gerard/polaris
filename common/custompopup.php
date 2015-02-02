<?php if (isset($_GET['custompopup'])) { ?>
    <div id="attributModifierMask">
    </div>
    <div id="customWindow">
        <div class="content">
            <?php include ROOT . $_GET['custompopup']; ?>
        </div>
        
        <div class="barreValid">

            <a href="<?php echo PolarisCore::getUrl(array(), true, array('custompopup')); ?>" class="redButton">Annuler</a>
        </div>
    </div>

<?php 
exit;
} ?>