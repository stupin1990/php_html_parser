<?php

namespace Src\Core\Validator;

use GuzzleHttp\Psr7\Response;

interface ResponseValidatorInterface
{
    /**
     * Create and return validator by type
     */
    public static function getValidator(Response $response, string $type) : BaseValidator;

    /**
     * Validate response content type
     */
    public static function validate(Response $response, string $type) : bool;

    /**
     * Validate response content type and die if invalid
     */
    public static function validateOrDie(Response $response, string $type);
}