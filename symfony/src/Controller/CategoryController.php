<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/categories')]
class CategoryController extends AbstractController
{

    #[Route('', name: 'category_index', methods: ['GET'])]
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


    #[Route('', name: 'category_store', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        return $this->json([
            'message' => 'Категорію успішно створено'
        ], 201);
    }

    #[Route('/{id}', name: 'category_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        return $this->json([
            'message' => 'Категорія знайдена',
            'data' => ['id' => $id, 'name' => 'Тестова категорія']
        ]);
    }

   
    #[Route('/{id}', name: 'category_update', methods: ['PUT', 'PATCH'])]
    public function update(int $id, Request $request): JsonResponse
    {
        return $this->json([
            'message' => 'Категорію успішно оновлено',
            'id' => $id
        ]);
    }


    #[Route('/{id}', name: 'category_delete', methods: ['DELETE'])]
    public function destroy(int $id): JsonResponse
    {
        return $this->json([
            'message' => 'Категорію успішно видалено',
            'id' => $id
        ]);
    }
}