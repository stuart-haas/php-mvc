<?php

use app\App;

require __DIR__.'/vendor/autoload.php';

DEFINE('APP_ROOT', __DIR__);
DEFINE('CONFIG_ROOT', __DIR__.'/config');
DEFINE('CONTROLLER_ROOT', __DIR__.'/src/controllers');

$app = new App();

