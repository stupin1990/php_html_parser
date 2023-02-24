<?php

namespace Src\Core\Validator;

interface validatorInterface
{

    /**
     * Validate response content
     */
    public function validate() : bool;

    /**
     * Get validator error message
     */
    public function getErrorMessage() : string;
}