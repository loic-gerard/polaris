<?php

use \PolarisCore;

$selectedAppz = PolarisCore::getFromUrl('appz', 'game');

include 'appz/'.$selectedAppz.'/index.php';