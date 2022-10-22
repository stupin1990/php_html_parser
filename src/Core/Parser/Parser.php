<?php

namespace HtmlParser;

class Parser
{
    protected string $content;

    public function __construct(string $content = '')
    {
        if (!$content) {
            throw new \Exception('Undefined content!');
        }

        $this->content = $content;
    }

    public function findTags() : array
    {
        preg_match_all("/\<(\w+)[\s|\>]/", $this->content, $matches);

        if (count($matches) != 2) {
            return [];
        }

        sort($matches[1]);

        return array_count_values($matches[1]);
    }
}