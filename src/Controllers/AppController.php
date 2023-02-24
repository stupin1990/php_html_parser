<?php

namespace Src\Controllers;

use Src\Core\Request\HttpHandler;
use Src\Core\Parser\Parser;
use Src\Services\Display;

/**
 * Main Interface for html parser
 */
final class AppController
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
     * Get amount of html tags from url
     * @return array [tag => amount]
     */
    public function getTagsFromUrl() : array
    {
        $http = new HttpHandler($this->url);
        $content = $http->getContent();

        $parser = new Parser($content);
        $tags = $parser->findTags();

        return $tags;
    }

    public function exec()
    {
        $tags = $this->getTagsFromUrl();

        Display::printKeysValuesTable($tags);
    }
}