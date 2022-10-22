<?php

namespace HtmlParser;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Core/Parser/HtmlParser.php';
require_once __DIR__ . '/src/Services/ViewService.php';


$url = $argv[1] ?? '';

$html_parser = new HtmlParser($url);

$tags = $html_parser->getTags();

echo 'Html tags amount:' . PHP_EOL;
ViewService::printArKeysVals($tags);

