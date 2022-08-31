<?php

namespace App\Beer\Application\Controller;

use App\Beer\Application\Infrastructure\Services\BeerHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BeerDetailController extends AbstractController
{
    #[Route('/detail/{id}')]
    public function __invoke(Request $request, BeerHandler $beerHandler, int $id): JsonResponse
    {
        $result = $beerHandler->detail($request, ['id' => $id, 'serializeContext' => ['id', 'name', 'description', 'image', 'slogan', 'firstBreweb']]);
        return $this->json($result);
    }
}