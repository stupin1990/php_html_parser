<?php

require_once __DIR__ . '/vendor/autoload.php';

use Src\Controllers\IndexController;

$url = $argv[1] ?? '';

$parser = new IndexController($url);
$parser->showAmountOfTagsInUrl();
