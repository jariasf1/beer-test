<?php

namespace App\Beer\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BeerListController extends AbstractController
{
    #[Route('/list')]
    public function __invoke(): JsonResponse
    {
        return $this->json(['datos' => 'jose']);
    }
}