<?php

namespace App\Beer\Application\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(protected string $value)
    {
        $this->value = trim($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}