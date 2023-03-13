<?php

namespace Src\Core\Validator;

use Src\Core\Request\ResponseDTO;

abstract class BaseValidator implements Interfaces\ValidatorInterface
{
    protected ResponseDTO $response;
    protected string $error_message = '';

    public function __construct(ResponseDTO $response)
    {
        $this->response = $response;
        $this->error_message = str_replace('{content_type}', $this->response->content_type, $this->error_message);
    }

    public function getErrorMessage() : string
    {
        return $this->error_message;
    }

    abstract public function validate() : bool;
}