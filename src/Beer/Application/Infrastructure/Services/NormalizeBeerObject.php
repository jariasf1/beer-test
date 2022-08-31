<?php

namespace App\Beer\Application\Infrastructure\Services;

use App\Beer\Application\Domain\Beer\Beer;
use App\Beer\Application\Domain\Beer\BeerDescription;
use App\Beer\Application\Domain\Beer\BeerFirstBreweb;
use App\Beer\Application\Domain\Beer\BeerId;
use App\Beer\Application\Domain\Beer\BeerImage;
use App\Beer\Application\Domain\Beer\BeerName;
use App\Beer\Application\Domain\Beer\BeerSlogan;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class NormalizeBeerObject
{

    public function normalize(string $beers)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->deserialize($beers, Beer::class, 'json');
    }

    public function arrayNormalize(array $beers): array
    {
        $beersObj = [];
        foreach ($beers as $beer) {
            $id = new BeerId($beer['id']);
            $name = new BeerName($beer['name']);
            $description = new BeerDescription($beer['description']);
            $slogan = new BeerSlogan($beer['tagline']);
            $firstBrewed = new BeerFirstBreweb($beer['first_brewed']);
            $image = new BeerImage($beer['image_url']);
            $beersObj[] = Beer::create($id, $name, $description, $image, $slogan, $firstBrewed);
        }
        return $beersObj;
    }
}