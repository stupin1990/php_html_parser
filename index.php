<?php

require_once __DIR__ . '/vendor/autoload.php';

use Src\Core\Parser\HtmlParser;
use Src\Services\Display;

$url = $argv[1] ?? '';

$html_parser = new HtmlParser($url);

$tags = $html_parser->getTags();

Display::printTagsTable($tags);

