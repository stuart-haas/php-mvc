<?php

use app\App;

require __DIR__.'/vendor/autoload.php';

DEFINE('APP_ROOT', __DIR__);
DEFINE('CONFIG_ROOT', APP_ROOT . DIRECTORY_SEPARATOR . 'config');
DEFINE('CONTROLLER_ROOT', APP_ROOT . DIRECTORY_SEPARATOR . 'src/controllers');
DEFINE('VIEW_ROOT', APP_ROOT . DIRECTORY_SEPARATOR . 'views');

$app = new App();

