<?php

namespace App\Http\Controllers;

use App\Filters\SubCategoryFilter;
use App\Http\Requests\Api\StoreSubCategoryRequest;
use App\Http\Requests\Api\UpdateSubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request){
        try{
            $filter = new SubCategoryFilter();

            $queryItems = $filter->transform($request);
    
            $includeWords = $request->query('includeWords');
    
            $subcategories = SubCategory::where($queryItems);
    
            if ($includeWords) {
                $subcategories = $subcategories->with('words');
            }
    
            $subcategories = $subcategories->orderBy('id');
    
            $subCategoryPaginated = $subcategories->paginate()->appends($request->query());

            return $this->paginatedResponse(
                $subCategoryPaginated->through(fn($subcategories) => new SubCategoryResource($subcategories)),
                '✅ Lista de subcategorías obtenida correctamente.'
            );
        }catch(Exception $e){
            return $this->exceptionResponse($e, '❌ Error al obtener las subcategorías.');
        }
    }

    public function store(StoreSubCategoryRequest $request){
        try
        {
            $subcategories = SubCategory::create($request->validated());

            return $this->successResponse(
                '✅ Subcategoría creada correctamente.',
                new SubCategoryResource($subcategories),
                201
            );
        }catch(Exception $e){
            return $this->errorResponse($e, '❌ No se pudo crear la sub categoría.');
        }
    }

    public function show(SubCategory $subcategory){
        try{
            $includeWords = request()->query('includeWords');

            if($includeWords){
                return new SubCategoryResource($subcategory->loadMissing('words'));
            }

            return $this->successResponse(
                '✅ Sub categoría obtenida correctamente.',
                new SubCategoryResource($subcategory)
            );
        } catch (Exception $e){
            return $this->exceptionResponse($e, '❌ No se pudo obtener la sub categoría.');
        }
    }

    public function update(UpdateSubCategoryRequest $request, SubCategory $subcategory){
        try{
            $updated = $subcategory->update($request->only(['category_id', 'subcategory']));

            if(!$updated){
                return $this->errorResponse('❌ No se pudo actualizar la categoría.');
            }

            return $this->successResponse(
                '✅ sub categoría actualizada correctamente.',
                new SubCategoryResource($subcategory)
            );
        }catch(Exception $e){
            return $this->errorResponse($e, '❌ Error al actualizar la sub categoría.');
        }
    }

    public function destroy(SubCategory $subcategory){
        try{
            $deleted =$subcategory->delete();

            if(!$deleted){
                return $this->errorResponse('❌ No se pudo eliminar la categoría.');
            }

            return $this->successResponse(
                '✅ La categoría se ha eliminado exitosamente.',
                new SubCategoryResource($subcategory)
            );
        }catch(Exception $e){
            return $this->exceptionResponse($e, '❌ Error al eliminar la sub categoría.');
        }
    }
}