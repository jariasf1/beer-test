<?php

namespace App\Beer\Application\Domain\Beer;

use App\Beer\Application\Domain\AggregateRoot;

class Beer extends AggregateRoot
{
    private int $id;

    public function __construct(
        BeerId $id,
        private BeerName $name,
        private BeerDescription $description,
        private BeerImage $image,
        private BeerSlogan $slogan,
        private BeerFirstBreweb $firstBreweb
    ) {
        $this->id = $id->value();
    }

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
        return $this->id;
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