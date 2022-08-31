<?php

namespace App\Beer\Application\Domain\ValueObject;

abstract class IdValueObject
{
    public function __construct(protected int $value)
    {
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}