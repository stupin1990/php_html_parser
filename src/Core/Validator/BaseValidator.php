<?php

namespace Src\Core\Validator;

use GuzzleHttp\Psr7\Response;

abstract class BaseValidator implements validatorInterface
{
    private Response $response;
    protected string $content_type;
    protected string $error_message = '';

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->content_type = $this->response->getHeader('Content-Type')[0];
        $this->error_message = str_replace('{content_type}', $this->content_type, $this->error_message);
    }

    public function getErrorMessage() : string
    {
        return $this->error_message;
    }

    abstract public function validate() : bool;
}