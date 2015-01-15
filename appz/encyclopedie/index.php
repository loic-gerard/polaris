<?php

use polarisapi\ui\menu\Menu;
use polarisapi\data\View;

$encycloMenuView = new View('ENCYCLOPEDIE', null, null, null, array('ENCYCLO_LABEL', 'ENCYCLO_CODE'));
$encylcoMenu = new Menu($encycloMenuView, 'encycloMenu', array('panel' => 'ENCYCLO_CODE'), 'REF_ARMEDISTANCE', true, array());

echo '<div id="col1Menu">';
echo $encylcoMenu->build();
echo '</div>';

if(isset($_GET['detailPage'])){
    echo '<div class="encycloPanel">';
    include ROOT.$_GET['detailPage'];
    echo '</div>';
}else if(isset($_GET['panel'])){
    echo '<div class="encycloPanel">';
    include ROOT.'appz/encyclopedie/PANELS/'.$_GET['panel'].'/index.php';
    echo '</div>';
}else{
    
    echo '<div class="encycloPanel">';
    include ROOT.'appz/encyclopedie/PANELS/REF_ARMEDISTANCE/index.php';
    echo '</div>';
}

