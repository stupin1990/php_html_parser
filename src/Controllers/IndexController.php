<?php

namespace Src\Controllers;

use Src\Core\Request\HttpHandler;
use Src\Core\Parser\Parser;
use Src\Services\Display;

/**
 * Main Interface for html parser
 */
final class IndexController
{
    private string $url; // url address string

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * Get html content from url and shows amount of its tags in console
     */
    public function showAmountOfTagsInUrl()
    {
        $http = new HttpHandler($this->url);
        $content = $http->getContent();

        $parser = new Parser($content);
        $tags = $parser->findTags();

        Display::printKeysValuesTable($tags);
    }
}