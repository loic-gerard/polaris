<?php

use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\ui\utils\AttributSelect;
use \PolarisCore;

$cv_attribut = null;
$cv_designation = '';
$cv_mod = 0;

//GET VALUE FOR EDIT
if($_GET['modificateur'] == 'EDIT'){
    $q = new Query();
    $q->setRequest('SELECT * FROM modificateur WHERE pk_modificateur='.$q->argument($_GET['editId'], Query::$SQL_NUMERIC));
    $q->execute();
    $data = $q->getQueryResults();
    
    $cv_attribut = $data->getValueAt('fk_attribut');
    $cv_designation = $data->getValueAt('tt_designation');
    $cv_mod = $data->getValueAt('fl_modificateur');
}

//DELETE
if($_GET['modificateur'] == 'DELETE'){
    $q = new Query();
    $q->setRequest('SELECT * FROM modificateur WHERE pk_modificateur='.$q->argument($_GET['editId'], Query::$SQL_NUMERIC));
    $q->execute();
    $data = $q->getQueryResults();
    
    $q = new Query();
    $q->setRequest('DELETE FROM modificateur '
            . 'WHERE fk_attribut='.$q->argument($data->getValueAt('fk_attribut'), Query::$SQL_NUMERIC).' '
            . 'AND fk_entite='.$q->argument($_GET['player'], Query::$SQL_NUMERIC));
    $q->execute();
    
    header('Location: '.PolarisCore::getUrl(array(), true, array('modificateur', 'editId')));
}

//ADD
if(isset($_POST['modificateurFormValid'])){
    $q = new Query();
    $q->setRequest('DELETE FROM modificateur '
            . 'WHERE fk_attribut='.$q->argument($_POST['attribut'], Query::$SQL_NUMERIC).' '
            . 'AND fk_entite='.$q->argument($_GET['player'], Query::$SQL_NUMERIC));
    $q->execute();
    
    $q = new Query();
    $q->setRequest('INSERT INTO modificateur '
            . '(fk_attribut,'
            . 'fk_entite,'
            . 'tt_designation,'
            . 'fl_modificateur) '
            . 'VALUES '
            . '('.$q->argument($_POST['attribut'], Query::$SQL_NUMERIC).','
            . $q->argument($_GET['player'], Query::$SQL_NUMERIC).','
            . $q->argument($_POST['designation'], Query::$SQL_STRING).','
            . $q->argument($_POST['mod'], Query::$SQL_NUMERIC).')');
    $q->execute();
    header('Location: '.PolarisCore::getUrl(array(), true, array('modificateur')));
}



?>

<div id="attributModifierMask"></div>
<div id="attributModifierWindow">
    <div class="content">
        <form method="POST" action="" id="modificateurForm">
            <input type="hidden" name="modificateurFormValid" value="<?php echo $_GET['modificateur']; ?>">
            
            <div class="editItem">
                <div class="label">Designation</div>
                <div class="form">
                    <input type="text" id="" name="designation" value="<?php echo $cv_designation; ?>">
                </div>
            </div>
            <div class="editItem">
                <div class="label">Attribut</div>
                <div class="form">
                   <?php
                   $as = new AttributSelect('PJ', 'attribut', $cv_attribut, null, 1);
                   echo $as->build();
                   
                   ?>
                </div>
            </div>
            <div class="editItem">
                <div class="label">Modificateur</div>
                <div class="form">
                    <input type="text" id="" name="mod" value="<?php echo $cv_mod; ?>">
                </div>
            </div>
        </form>
    </div>

    <div class="barreValid">
        <a href="javascript:document.getElementById('modificateurForm').submit();" class="greenButton">Valider</a>
        <a href="<?php echo PolarisCore::getUrl(array(), true, array('modificateur', 'editId')); ?>" class="redButton">Annuler</a>
    </div>
</div>
