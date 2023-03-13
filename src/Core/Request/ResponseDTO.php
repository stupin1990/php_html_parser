<?php

namespace Src\Core\Request;

use GuzzleHttp\Psr7\Response;

class ResponseDTO
{
    public string $body = '';
    public string $status = '';
    public string $content_type = '';

    public function __construct(Response $response = null)
    {
        if (is_null($response)) {
            return;
        }

        $this->body = $response->getBody()->getContents();
        $this->status = $response->getStatusCode();
        $this->content_type = $response->getHeader('Content-Type')[0];
    }

    public function setData(array $data) : void
    {
        foreach ($data as $prop => $val) {
            if (isset($this->$prop)) {
                $this->$prop = $val;
            }
        }
    }
}