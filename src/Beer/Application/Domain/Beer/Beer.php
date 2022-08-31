<?php

namespace App\Beer\Application\Domain\Beer;

use App\Beer\Application\Domain\AggregateRoot;

class Beer extends AggregateRoot
{
    public function __construct(
        private BeerId $id,
        private BeerName $name,
        private BeerDescription $description,
        private BeerImage $image,
        private BeerSlogan $slogan,
        private BeerFirstBreweb $firstBreweb
    ) {}

    public static function create(
        BeerId $id,
        BeerName $name,
        BeerDescription $description,
        BeerImage $image,
        BeerSlogan $slogan,
        BeerFirstBreweb $firstBreweb
    ): self {
        return new self(
            id: $id,
            name: $name,
            description: $description,
            image: $image,
            slogan: $slogan,
            firstBreweb: $firstBreweb
        );
    }

    public function id(): int
    {
        return $this->id->value();
    }

    public function name(): BeerName
    {
        return $this->name;
    }

    public function description(): BeerDescription
    {
        return $this->description;
    }

    public function image(): BeerImage
    {
        return $this->image;
    }

    public function slogan(): BeerSlogan
    {
        return $this->slogan;
    }

    public function firstBreweb(): BeerFirstBreweb
    {
        return $this->firstBreweb;
    }
}