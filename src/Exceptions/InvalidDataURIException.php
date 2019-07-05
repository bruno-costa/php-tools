<?php

namespace Yq\Exceptions;

class InvalidDataURIException extends UnexpectedValueException
{
    public function getReadableCode(): string
    {
        return 'InvalidBase64';
    }
}
