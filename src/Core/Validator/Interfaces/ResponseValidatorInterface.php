<?php

namespace Src\Core\Validator\Interfaces;

use Src\Core\Request\ResponseDTO;

interface ResponseValidatorInterface
{
    /**
     * Validate response content type
     */
    public static function validate(ResponseDTO $response, string $type) : void;
}