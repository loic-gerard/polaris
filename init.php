<?php

include 'config.php';
include 'framework-jin/jin/launcher.php';

include 'polarisapi/data/view.php';
include 'polarisapi/data/attribut/attribut.php';
include 'polarisapi/data/attribut/carac.php';


//Gestion des erreurs
error_reporting(E_ALL);
ini_set("display_errors", 1);

//Connexion BDD
use jin\db\DbConnexion;
DbConnexion::connectWithMySql(DB_HOST, DB_USER, DB_PASS, DB_PORT, DB_NAME);

