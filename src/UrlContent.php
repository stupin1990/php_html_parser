<?php

namespace Src;

require_once __DIR__ . '/Request.php';

class UrlContent extends Request
{
    public function __construct(string $url = '')
    {
        parent::__construct($url);
    }
    
    public function getContent() : string
    {
        $content = $this->get();
        if (empty($content)) {
            throw new \Exception('Page is empty!');
        }

        return $content;
    }
}