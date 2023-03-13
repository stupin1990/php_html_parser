<?php

namespace Src\Core\Validator;

class TextValidator extends BaseValidator
{
    protected string $error_message = 'Content is not a text! ({content_type})';

    public function validate() : bool
    {
        return strpos($this->response->content_type, 'text/html') !== false;
    }
}