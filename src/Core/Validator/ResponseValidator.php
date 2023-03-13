<?php

namespace Src\Core\Validator;
use Src\Core\Request\ResponseDTO;

/**
 * Main validation class
 */
class ResponseValidator implements Interfaces\ResponseValidatorInterface
{
    public static function validate(ResponseDTO $response, string $type) : void
    {
        $validator = ValidatorFactory::create($response, $type);

        if (!$validator->validate()) {
            die($validator->getErrorMessage());
        }
    }
}