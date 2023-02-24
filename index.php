<?php

require_once __DIR__ . '/vendor/autoload.php';

use Src\Controllers\AppController;

$url = $argv[1] ?? '';

$app = new AppController($url);
$app->exec();
