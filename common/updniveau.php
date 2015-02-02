<?php

use polarisapi\data\Entite;
use polarisapi\data\attribut\Attribut;

$a = Attribut::getAttribut($_POST['joueur'], $_POST['talent']);
$av = (int)$a->getValue('initial');
$av = $av+10;
$a->setValue($av, 'initial');