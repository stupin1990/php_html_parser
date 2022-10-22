<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/HtmlParser.php';


$url = $argv[1] ?? '';

$html_parser = new Src\HtmlParser($url);

$tags = $html_parser->getTags();

echo 'Html tags amount:' . PHP_EOL;
print_r($tags);
