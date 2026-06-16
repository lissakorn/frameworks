<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;


class CategoryController extends AbstractController
{

    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Список категорій',
            'data' => [
                ['id' => 1, 'name' => 'Електроніка'],
                ['id' => 2, 'name' => 'Одяг']
            ]
        ]);
    }
}