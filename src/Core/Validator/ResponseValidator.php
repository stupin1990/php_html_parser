<?php

namespace Src\Core\Validator;
use GuzzleHttp\Psr7\Response;

class ResponseValidator implements ResponseValidatorInterface
{
    private Response $response;
    private string $content_type;

    private array $error_messages = [
        'text' => 'Content is not a text! ({content_type})',
        'json' => 'Content is not a json! ({content_type})',
        'xml' => 'Content is not an xml! ({content_type})',
    ];

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->content_type = $this->response->getHeader('Content-Type')[0];

        foreach ($this->error_messages as &$error_message) {
            $error_message = str_replace('{content_type}', $this->content_type, $error_message);
        }
    }

    public function isText() : bool
    {
        return strpos($this->content_type, 'text/html') !== false;
    }

    public function isJson() : bool
    {
        return strpos($this->content_type, 'application/json') !== false;
    }

    public function isXml() : bool
    {
        return strpos($this->content_type, 'application/xml') !== false;
    }

    public function validateTypeOrDie(string $type)
    {
        switch ($type) {
            case 'text':
                $res = $this->isText();
                break;
            case 'json':
                $res = $this->isJson();
                break;
            case 'xml':
                $res = $this->isXml();
                break;
            default:
                $res = true;
                break;
        }

        if (!$res) {
            die($this->error_messages[$type]);
        }
    }
}