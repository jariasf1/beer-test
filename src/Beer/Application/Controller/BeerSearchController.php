<?php

namespace App\Beer\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BeerSearchController extends AbstractController
{
    #[Route('/search')]
    public function __invoke(Request $request): JsonResponse
    {
        $q = $request->get('q');
        return $this->json(['datos' => $q]);
    }
}