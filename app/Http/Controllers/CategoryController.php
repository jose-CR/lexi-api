<?php

namespace App\Http\Controllers;

use App\Filters\CategoryFilter;
use App\Http\Requests\Api\StoreCategoryRequest;
use App\Http\Requests\Api\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $filter = new CategoryFilter();

        $queryItems = $filter->transform($request);

        $includeSubCategories = $request->query('includeSubCategories');

        $categories = Category::where($queryItems);

        if ($includeSubCategories) {
            $categories = $categories->with('subcategories');
        }

        $category = $categories->orderBy('id');

        $categoryPaginated = $category->paginate()->appends($request->query());

        return response()->json([
            'info' => [
                'count' => $categoryPaginated->total(),
                'pages' => $categoryPaginated->lastPage(),
                'next' => $categoryPaginated->nextPageUrl(),
                'prev' => $categoryPaginated->previousPageUrl(),
            ],

            'data' => CategoryResource::collection($categoryPaginated),

            'meta' => [
                'current_page' => $categoryPaginated->currentPage(),
                'per_page' => $categoryPaginated->perPage(),
                'from' => $categoryPaginated->firstItem(),
                'to' => $categoryPaginated->lastItem(),
                'last_page' => $categoryPaginated->lastPage(),
                'total' => $categoryPaginated->total()
            ],

            'links' => [
                'first' => $categoryPaginated->url(1),
                'prev' => $categoryPaginated->previousPageUrl(),
                'next' => $categoryPaginated->nextPageUrl(),
                'last' => $categoryPaginated->url($categoryPaginated->lastPage()),
            ],
        ]);
    }

    public function store(StoreCategoryRequest $request){
        $category = Category::create($request->all());

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'color' => 'red',
                'message' => '❌ No se pudo crear una nueva categoría.',
            ], 500);
        }
    
        return response()->json([
            'status' => 'success',
            'color' => 'green',
            'message' => '✅ Se ha creado una nueva categoría correctamente.',
            'data' => new CategoryResource($category)
        ], 201);
    }

    public function show(Category $category){
        $includeSubCategory = request()->query('includeSubCategories');

        if($includeSubCategory){
            return new CategoryResource($category->loadMissing('subcategories'));
        }

        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category){
        $updated = $category->update($request->all());

        if(!$updated){
            return response()->json([
                'status' => 'error',
                'color' => 'red',
                'message' => '❌ No se pudo actualizar la categoría.',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'color' => 'green',
            'message' => '✅ Categoría actualizada correctamente.',
            'data' => new CategoryResource($category)
        ], 200);

    }

    public function destroy(Category $category){
        $deleted = $category->delete();

        if(!$deleted){
            return response()->json([
                'status' => 'error',
                'color' => 'red',
                'message' => "❌ No se pudo eliminar la categoria"
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'color' => 'green',
            'message' => "✅ La Categoria se ha eliminado exitosamente",
            'data' => new CategoryResource($category)
        ], 200);
    }
}
