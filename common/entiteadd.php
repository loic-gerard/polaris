<?php

use \PolarisCore;
use polarisapi\data\attribut\Attribut;
use jin\dataformat\Json;
?>


<?php
if (isset($_GET['addEntite'])) {
    
    $toEdit = Json::decode($_GET['toEdit']);
    $toSet = Json::decode($_GET['toSet']);
    $parent = $_GET['parent'];
    $entiteType = $_GET['addEntite'];
   
    ?>
    <div id="attributModifierMask"></div>
    <div id="entiteAddWindow">
        <div class="content">
            <form method="POST" action="" id="entiteAddForm">
                <input type="hidden" name="entiteAddFormValid" value="1">
    <?php
    
    foreach($toEdit AS $c){
        $attribut = Attribut::getAttribut(null, $c);
        echo '<div class="editItem">';
        echo '<div class="label">'.$attribut->getAttributName().'</div>';
        echo '<div class="form">';
        echo $attribut->renderForEdit();
        echo '</div>';
        echo '</div>';
    }
    
    foreach($toSet AS $c => $v){
        $attribut = Attribut::getAttribut(null, $c);
        echo '<input type="hidden" name="'.$c.'_" value="'.$v.'">';

    }

    ?>
            </form>
        </div>

        <div class="barreValid">
            <a href="javascript:document.getElementById('entiteAddForm').submit();" class="greenButton">Valider</a>
            <a href="<?php echo PolarisCore::getUrl(array(), true, array('addEntite', 'toEdit', 'toSet', 'parent')); ?>" class="redButton">Annuler</a>
        </div>
    </div>
    <?php
}
?>
