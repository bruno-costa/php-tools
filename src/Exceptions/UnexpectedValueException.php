<?php

namespace Yq\Exceptions;

use Throwable;

abstract class UnexpectedValueException extends \UnexpectedValueException
{
    abstract public function getReadableCode(): string;

    public function __construct($valueGetted = null, string $message = "", Throwable $previous = null)
    {
        $prevMessage = "[Unexpected Value \"$valueGetted\"]";
        if ($message) {
            $prevMessage .= " $message";
        }
        parent::__construct($prevMessage, 0, $previous);
        $this->code = $this->getReadableCode();
    }
}
