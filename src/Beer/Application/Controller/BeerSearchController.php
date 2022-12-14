<?php

namespace App\Beer\Application\Controller;

use App\Beer\Application\Infrastructure\Services\BeerHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BeerSearchController extends AbstractController
{
    #[Route('/search')]
    public function __invoke(Request $request, BeerHandler $beerHandler): JsonResponse
    {
        $result = $beerHandler->search($request, ['q' => $request->get('q'), 'serializeContext' => ['id', 'name', 'description']]);
        return $this->json($result);
    }
}