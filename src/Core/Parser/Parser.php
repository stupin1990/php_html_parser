<?php

namespace Src\Core\Parser;

class Parser implements Interfaces\ParserInterface
{
    protected string $content;

    /**
     * @param string $content - string with html tags
     */
    public function __construct(string $content = '')
    {
        if (!$content) {
            die('Undefined content!');
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