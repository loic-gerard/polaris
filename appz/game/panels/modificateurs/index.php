<?php

use jin\output\components\ui\table\Table;
use jin\output\components\ui\table\TableModel;
use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\ui\categorie\FreeCategorie;
use \PolarisCore;

$ediUrl = PolarisCore::getUrl(array('modificateur' => 'EDIT'), true, array()).'&editId=';
$delUrl = PolarisCore::getUrl(array('modificateur' => 'DELETE'), true, array()).'&editId=';

$q = new Query();
$q->setRequest('SELECT '
        . 'm.tt_designation,'
        . 'CONCAT(c.tt_designation, \'>\', a.tt_designation) AS attribut,'
        . 'm.fl_modificateur,'
        . 'CONCAT(\''.$ediUrl.'\',m.pk_modificateur) AS urlEdit, '
        . 'CONCAT(\''.$delUrl.'\',m.pk_modificateur) AS urlDel '
        . 'FROM modificateur AS m '
        . 'JOIN attribut AS a ON a.pk_attribut = m.fk_attribut '
        . 'JOIN categorie AS c ON c.pk_categorie = a.fk_categorie '
        . 'WHERE m.fk_entite='.$q->argument($selectedPlayer, Query::$SQL_NUMERIC).' '
        . '');
$q->execute();
$qr = $q->getQueryResults();

$tableModel = new TableModel();
$tableModel->setColComponent(3, 'polarisapi\ui\jincomponents\EditButton');
$tableModel->setColComponent(4, 'polarisapi\ui\jincomponents\DelButton');

$table = new Table('modificateurs');
$table->setTableModel($tableModel);

$table->setHeaders(array('Designation', 'Attribut', 'Modificateur', '', ''));
$table->addColumnClass('smallColumn', 3);
$table->addColumnClass('smallColumn', 4);
        
$table->setDataSource($qr);

$c = new FreeCategorie('Modificateurs');
$c->setHeader('<a href="'.PolarisCore::getUrl(array('modificateur' => 'ADD'), true, array()).'" class="greenButton">Ajouter</a>');
echo $c->build($table->render());
