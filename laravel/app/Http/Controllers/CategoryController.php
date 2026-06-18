<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    private const CATEGORIES = [
        1 => ['id' => 1, 'name' => 'Electronics', 'description' => 'Gadgets and devices'],
        2 => ['id' => 2, 'name' => 'Books', 'description' => 'All kinds of books'],
        3 => ['id' => 3, 'name' => 'Clothing', 'description' => 'Apparel and accessories'],
    ];

    
    public function index()
    {
        return response()->json(self::CATEGORIES);
    }

   
    public function show($id)
    {
        if (!isset(self::CATEGORIES[$id])) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        return response()->json(self::CATEGORIES[$id]);
    }

    
    public function store(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description', '');

        if (!$name) {
            return response()->json(['error' => 'Name field is required'], 400);
        }

        
        $mockData = self::CATEGORIES;
        $newId = max(array_keys($mockData)) + 1;
        
        $newCategory = [
            'id' => $newId,
            'name' => $name,
            'description' => $description
        ];
        
        $mockData[$newId] = $newCategory;

        return response()->json([
            'message' => 'Category successfully created (simulated)',
            'created_item' => $newCategory,
            'all_categories_snapshot' => $mockData
        ], 201);
    }

    
    public function update(Request $request, $id)
    {
        if (!isset(self::CATEGORIES[$id])) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $mockData = self::CATEGORIES;
        
        if ($request->has('name')) {
            $mockData[$id]['name'] = $request->input('name');
        }
        if ($request->has('description')) {
            $mockData[$id]['description'] = $request->input('description');
        }

        return response()->json([
            'message' => 'Category successfully updated (simulated)',
            'updated_item' => $mockData[$id],
            'all_categories_snapshot' => $mockData
        ]);
    }

    
    public function destroy($id)
    {
        if (!isset(self::CATEGORIES[$id])) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $mockData = self::CATEGORIES;
        unset($mockData[$id]); 

        return response()->json([
            'message' => 'Category successfully deleted (simulated)',
            'all_categories_snapshot' => $mockData
        ]);
    }
}