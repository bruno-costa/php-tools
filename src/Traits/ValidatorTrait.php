<?php

namespace Yq\Traits;

use Yq\Tools\Validator;

trait ValidatorTrait
{
    public abstract function validate(): Validator;

    public function isValid(): bool
    {
        return $this->validate()->isValid();
    }
}
