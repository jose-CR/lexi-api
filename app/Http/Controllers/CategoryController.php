<?php

namespace App\Http\Controllers;

use App\Filters\CategoryFilter;
use App\Http\Requests\Api\StoreCategoryRequest;
use App\Http\Requests\Api\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request){
        try
        {
            $filter = new CategoryFilter();

            $queryItems = $filter->transform($request);
    
            $includeSubCategories = $request->query('includeSubCategories');
    
            $categories = Category::where($queryItems);
    
            if ($includeSubCategories) {
                $categories = $categories->with('subcategories');
            }
    
            $category = $categories->orderBy('id');
    
            $categoryPaginated = $category->paginate()->appends($request->query());
    
            return $this->paginatedResponse(
                $categoryPaginated->through(fn($category) => new CategoryResource($category)),
                '✅ Lista de categorías obtenida correctamente.'
            );
        }catch(Exception $e){
            return $this->exceptionResponse($e, '❌ Error al obtener las categorías.');
        }
    }

    public function store(StoreCategoryRequest $request){
        try{
            $category = Category::create($request->validated());

            return $this->successResponse(
                '✅ Categoría creada correctamente.',
                new CategoryResource($category),
                201
            );

        }catch(Exception $e){
            return $this->errorResponse($e, '❌ No se pudo crear la categoría.');
        }
    }

    public function show(Category $category){
        try {
            $includeSubCategory = request()->query('includeSubCategories');
    
            if ($includeSubCategory) {
                $category->loadMissing('subcategories');
            }
    
            return $this->successResponse(
                '✅ Categoría obtenida correctamente.',
                new CategoryResource($category)
            );
    
        } catch (Exception $e) {
            return $this->exceptionResponse($e, '❌ No se pudo obtener la categoría.');
        }
    }

    public function update(UpdateCategoryRequest $request, Category $category){
        try
        {
            $updated = $category->update($request->validated());

            if(!$updated)
            {
                return $this->errorResponse('❌ No se pudo actualizar la categoría.');
            }

            return $this->successResponse(
                '✅ Categoría actualizada correctamente.',
                new CategoryResource($category)
            );


        }catch(Exception $e)
        {
            return $this->errorResponse($e, '❌ Error al actualizar la categoría.');
        }
    }

    public function destroy(Category $category){
        try
        {
            $deleted = $category->delete();

            if(!$deleted){
                return $this->errorResponse('❌ No se pudo eliminar la categoría.');
            }

            return $this->successResponse(
                '✅ La categoría se ha eliminado exitosamente.',
                new CategoryResource($category)
            );
        }catch(Exception $e){
            return $this->exceptionResponse($e, '❌ Error al eliminar la categoría.');
        }
    }
}
