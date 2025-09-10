<?php

namespace App\Http\Controllers;

use App\Filters\SubCategoryFilter;
use App\Http\Requests\Api\StoreSubCategoryRequest;
use App\Http\Requests\Api\UpdateSubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function index(Request $request){
        $filter = new SubCategoryFilter();

        $queryItems = $filter->transform($request);

        $includeWords = $request->query('includeWords');

        $subcategories = SubCategory::where($queryItems);

        if ($includeWords) {
            $subcategories = $subcategories->with('words');
        }

        $subcategories = $subcategories->orderBy('id');

        $subCategoryPaginated = $subcategories->paginate()->appends($request->query());

        return response()->json([
            'info' => [
                'count' => $subCategoryPaginated->total(),
                'pages' => $subCategoryPaginated->lastPage(),
                'next' => $subCategoryPaginated->nextPageUrl(),
                'prev' => $subCategoryPaginated->previousPageUrl(),
            ],

            'data' => SubCategoryResource::collection($subCategoryPaginated),

            'meta' => [
                'current_page' => $subCategoryPaginated->currentPage(),
                'per_page' => $subCategoryPaginated->perPage(),
                'from' => $subCategoryPaginated->firstItem(),
                'to' => $subCategoryPaginated->lastItem(),
                'last_page' => $subCategoryPaginated->lastPage(),
                'total' => $subCategoryPaginated->total()
            ],

            'links' => [
                'first' => $subCategoryPaginated->url(1),
                'prev' => $subCategoryPaginated->previousPageUrl(),
                'next' => $subCategoryPaginated->nextPageUrl(),
                'last' => $subCategoryPaginated->url($subCategoryPaginated->lastPage()),
            ],
        ]);
    }

    public function store(StoreSubCategoryRequest $request){
        $subcategories = SubCategory::create($request->all());

        if(!$subcategories){
            return response()->json([
                'status' => 'error',
                'color' => 'red',
                'message' => '❌ No se pudo crear una nueva sub categoría.',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'color' => 'green',
            'message' => '✅ Se ha creado una nueva sub categoría correctamente.',
            'data' => new SubCategoryResource($subcategories)
        ], 201);
    }

    public function show(SubCategory $subcategory){
        $includeWords = request()->query('includeWords');

        if($includeWords){
            return new SubCategoryResource($subcategory->loadMissing('words'));
        }

        return new SubCategoryResource($subcategory);
    }

    public function update(UpdateSubCategoryRequest $request, SubCategory $subcategory){
        $updated = $subcategory->update($request->only(['category_id', 'subcategory']));

        if(!$updated){
            return response()->json([
                'status' => 'error',
                'color' => 'red',
                'message' => '❌ No se pudo actualizar la sub categoría.',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'color' => 'green',
            'message' => '✅ sub categoría actualizada correctamente.',
            'data' => new SubCategoryResource($subcategory)
        ], 200);
    }

    public function destroy(SubCategory $subcategory){
        $deleted =$subcategory->delete();
     
        if(!$deleted){
            return response()->json([
                'status' => 'error',
                'color' => 'red',
                'message' => "❌ No se pudo eliminar la sub categoria"
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'color' => 'green',
            'message' => "✅ La sub categoria se ha eliminado exitosamente",
            'data' => new SubCategoryResource($subcategory)
        ], 200);
    }
}
