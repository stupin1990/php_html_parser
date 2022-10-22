<?php

namespace Src;

require_once __DIR__ . '/UrlContent.php';
require_once __DIR__ . '/Parser.php';

class HttpParser
{
    protected string $url;
    protected string $content;
    protected array $tags;

    public function __construct(string $url = '')
    {
        $this->url = $url;

        try {
            $request = new UrlContent($url);
            $this->content = $request->getContent();

            $parser = new Parser($this->content);
            $this->tags = $parser->findTags();
        }
        catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function getContent() : string
    {
        return $this->content ?? '';
    }

    public function getTags() : array
    {
        return $this->tags ?? [];
    }
}