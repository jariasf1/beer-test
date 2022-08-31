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
    public function normalize(array $beers): array
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

    public function serializer(mixed $object, array $context = [])
    {
        $data = [];
        foreach ($context as $item) {
            if ($item === 'id')
            {
                $data[$item] = $object->$item();
            } else {
                $data[$item] = $object->$item()->value();
            }
        }

        return $data;
    }
}