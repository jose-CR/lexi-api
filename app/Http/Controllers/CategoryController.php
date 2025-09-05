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
    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Listar todas las categorías",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="includeSubCategories",
     *         in="query",
     *         description="Incluir subcategorías en la respuesta",
     *         required=false,
     *         @OA\Schema(type="boolean", example=true)
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Número de página para la paginación",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Listado de categorías"
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/categories",
     *     summary="Crear una nueva categoría",
     *     description="Crea una categoría con los datos enviados",
     *     tags={"Categories"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Nueva categoría")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Categoría creada correctamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="color", type="string", example="green"),
     *             @OA\Property(property="message", type="string", example="✅ Se ha creado una nueva categoría correctamente."),
     *             @OA\Property(property="data", ref="#/components/schemas/Category")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al crear la categoría"
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/categories/{id}",
     *     summary="Obtener una categoría",
     *     description="Devuelve los detalles de una categoría, con opción de incluir subcategorías",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la categoría",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="includeSubCategories",
     *         in="query",
     *         required=false,
     *         description="Incluir subcategorías",
     *         @OA\Schema(type="boolean", example=true)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoría obtenida correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoría no encontrada"
     *     )
     * )
     */
    public function show(Category $category){
        $includeSubCategory = request()->query('includeSubCategories');

        if($includeSubCategory){
            return new CategoryResource($category->loadMissing('subcategories'));
        }

        return new CategoryResource($category);
    }

    /**
     * @OA\Put(
     *     path="/categories/{id}",
     *     summary="Actualizar una categoría",
     *     description="Actualiza los datos de una categoría existente",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la categoría",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Categoría Actualizada")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoría actualizada correctamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="color", type="string", example="green"),
     *             @OA\Property(property="message", type="string", example="✅ Categoría actualizada correctamente."),
     *             @OA\Property(property="data", ref="#/components/schemas/Category")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar la categoría"
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/categories/{id}",
     *     summary="Eliminar una categoría",
     *     description="Elimina la categoría especificada",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la categoría",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoría eliminada correctamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="color", type="string", example="green"),
     *             @OA\Property(property="message", type="string", example="✅ La Categoria se ha eliminado exitosamente"),
     *             @OA\Property(property="data", ref="#/components/schemas/Category")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al eliminar la categoría"
     *     )
     * )
     */
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
