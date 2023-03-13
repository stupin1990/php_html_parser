<?php

namespace Src\Core\Validator;
use Src\Core\Request\ResponseDTO;

/**
 * Main validation static factory
 */
class ValidatorFactory implements Interfaces\ValidatorFactoryInterface
{
    public static function create(ResponseDTO $response, string $type) : Interfaces\validatorInterface
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
}