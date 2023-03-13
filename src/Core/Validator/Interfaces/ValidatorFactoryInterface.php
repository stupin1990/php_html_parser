<?php

namespace Src\Core\Validator\Interfaces;

use Src\Core\Request\ResponseDTO;

interface ValidatorFactoryInterface
{
    /**
     * Create and return validator by type
     */
    public static function create(ResponseDTO $response, string $type) : validatorInterface;
}