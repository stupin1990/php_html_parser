<?php

namespace Src\Core\Validator;

class JsonValidator extends BaseValidator
{
    protected string $error_message = 'Content is not a json! ({content_type})';

    public function validate() : bool
    {
        return strpos($this->response->content_type, 'application/json') !== false;
    }
}