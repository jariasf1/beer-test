<?php

namespace App\Beer\Application\Domain\ValueObject;

abstract class JsonValueObject
{
    public function __construct(protected array $value)
    {
    }

    public function value(): array
    {
        return $this->value;
    }
}