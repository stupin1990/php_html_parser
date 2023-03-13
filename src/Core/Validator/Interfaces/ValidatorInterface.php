<?php

namespace Src\Core\Validator\Interfaces;

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