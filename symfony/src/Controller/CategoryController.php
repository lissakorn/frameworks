<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/categories')]
class CategoryController extends AbstractController
{
   
    private const CATEGORIES = [
        1 => ['id' => 1, 'name' => 'Electronics', 'description' => 'Gadgets and devices'],
        2 => ['id' => 2, 'name' => 'Books', 'description' => 'All kinds of books'],
        3 => ['id' => 3, 'name' => 'Clothing', 'description' => 'Apparel and accessories'],
    ];

    #[Route('', name: 'category_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json(self::CATEGORIES);
    }

    #[Route('/{id}', name: 'category_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        if (!isset(self::CATEGORIES[$id])) {
            return $this->json(['error' => 'Category not found'], 404);
        }
        return $this->json(self::CATEGORIES[$id]);
    }

    #[Route('', name: 'category_store', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $name = $data['name'] ?? null;
        $description = $data['description'] ?? '';

        if (!$name) {
            return $this->json(['error' => 'Name field is required'], 400);
        }

        $mockData = self::CATEGORIES;
        $newId = max(array_keys($mockData)) + 1;
        
        $newCategory = [
            'id' => $newId,
            'name' => $name,
            'description' => $description
        ];
        $mockData[$newId] = $newCategory;

        return $this->json([
            'message' => 'Category successfully created (simulated)',
            'created_item' => $newCategory,
            'all_categories_snapshot' => $mockData
        ], 201);
    }

    #[Route('/{id}', name: 'category_update', methods: ['PATCH'])]
    public function update(int $id, Request $request): JsonResponse
    {
        if (!isset(self::CATEGORIES[$id])) {
            return $this->json(['error' => 'Category not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        $mockData = self::CATEGORIES;

        if (isset($data['name'])) {
            $mockData[$id]['name'] = $data['name'];
        }
        if (isset($data['description'])) {
            $mockData[$id]['description'] = $data['description'];
        }

        return $this->json([
            'message' => 'Category successfully updated (simulated)',
            'updated_item' => $mockData[$id],
            'all_categories_snapshot' => $mockData
        ]);
    }

    #[Route('/{id}', name: 'category_destroy', methods: ['DELETE'])]
    public function destroy(int $id): JsonResponse
    {
        if (!isset(self::CATEGORIES[$id])) {
            return $this->json(['error' => 'Category not found'], 404);
        }

        $mockData = self::CATEGORIES;
        unset($mockData[$id]);

        return $this->json([
            'message' => 'Category successfully deleted (simulated)',
            'all_categories_snapshot' => $mockData
        ]);
    }
}