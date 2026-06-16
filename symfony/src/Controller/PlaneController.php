<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PlaneController extends AbstractController
{
    #[Route('/api/planes', name: 'get_planes', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Список літаків',
            'data' => [
                ['id' => 1, 'model' => 'Boeing 747'],
                ['id' => 2, 'model' => 'Airbus A380']
            ]
        ]);
    }
}