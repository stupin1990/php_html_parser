<?php

namespace Src\Core\Validator;

interface ResponseValidatorInterface
{
    /**
     * Validate as text
     */
    public function isText() : bool;

    /**
     * Validate as json
     */
    public function isJson() : bool;

    /**
     * Validate as xml
     */
    public function isXml() : bool;

    /**
     * Validate response content type and die if invalid
     */
    public function validateTypeOrDie(string $type);
}