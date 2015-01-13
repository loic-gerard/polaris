<?php

use \PolarisCore;
use polarisapi\data\attribut\Attribut;

?>


<?php
if (isset($_GET['modAttr']) && isset($_GET['modId'])) {
    ?>
    <div id="attributModifierMask"></div>
    <div id="attributModifierWindow">
        <div class="content">
            <form method="POST" action="" id="attributModifierForm">
                <input type="hidden" name="attributModifierFormValid" value="1">
    <?php
    $attribut = Attribut::getAttribut($_GET['modId'], $_GET['modAttr']);
    echo '<div class="editItem">';
    echo '<div class="label">'.$attribut->getAttributName().'</div>';
    echo '<div class="form">';
    echo $attribut->renderForEdit();
    echo '</div>';
    echo '</div>';
    
    ?>
            </form>
        </div>

        <div class="barreValid">
            <a href="javascript:document.getElementById('attributModifierForm').submit();" class="greenButton">Valider</a>
            <a href="<?php echo PolarisCore::getUrl(array(), true, array('modAttr', 'modId')); ?>" class="redButton">Annuler</a>
        </div>
    </div>
    <?php
}
?>
