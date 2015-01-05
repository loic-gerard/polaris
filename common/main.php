<?php

use polarisapi\data\View;
use jin\log\Debug;

$v = new View('PJ', 'pk_entite', 'ASC', null, array('FO'));
Debug::dump($v->getDatas());
