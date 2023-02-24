<?php

namespace Src\Core\Validator;
use GuzzleHttp\Psr7\Response;

/**
 * Main validation static factory
 */
class ResponseValidator implements ResponseValidatorInterface
{
    public static function getValidator(Response $response, string $type) : BaseValidator
    {
        switch ($type) {
            case 'text':
                return new TextValidator($response);
                break;
            case 'json':
                return new JsonValidator($response);
                break;
            case 'xml':
                return new XmlValidator($response);
                break;
            default:
                throw new \Exception('Undefined validator!');
                break;
        }
    }

    public static function validate(Response $response, string $type) : bool
    {
        return static::getValidator($response, $type)->validate();
    }

    public static function validateOrDie(Response $response, string $type)
    {
        $validator = static::getValidator($response, $type);

        if (!$validator->validate()) {
            die($validator->getErrorMessage());
        }
    }
}