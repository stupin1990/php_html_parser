<?php

namespace Src\Core\Parser\Interfaces;


interface ParserInterface
{
    /**
     * Get all tags and their amount from string
     * @return array [tag => amount]
     */
    public function findTags() : array;
}