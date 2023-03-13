<?php

namespace Src\Core\Validator;

class XmlValidator extends BaseValidator
{
    protected string $error_message = 'Content is not an xml! ({content_type})';

    public function validate() : bool
    {
        return strpos($this->response->content_type, 'application/xml') !== false;
    }
}