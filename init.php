<?php

//Default includes
include 'config.php';
include 'framework-jin/jin/launcher.php';
include 'polarisapi/polariscore.php';

//Default GMT
date_default_timezone_set('GMT');

//Gestion des erreurs
error_reporting(E_ALL);
ini_set("display_errors", 1);
spl_autoload_register(array('PolarisCore', 'autoload'));

use jin\JinCore;
define('ROOT', jinCore::getContainerPath());

//Connexion BDD
use jin\db\DbConnexion;
DbConnexion::connectWithMySql(DB_HOST, DB_USER, DB_PASS, DB_PORT, DB_NAME);

