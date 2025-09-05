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
/**
     * @OA\Get(
     *     path="/subcategories",
     *     summary="Listar todas las subcategorías",
     *     description="Muestra un listado paginado de subcategorías. Puede incluir palabras relacionadas si se solicita.",
     *     tags={"SubCategories"},
     *     @OA\Parameter(
     *         name="includeWords",
     *         in="query",
     *         required=false,
     *         description="Incluir palabras asociadas",
     *         @OA\Schema(type="boolean", example=true)
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         description="Número de página",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Listado de subcategorías con paginación",
     *         @OA\JsonContent(
     *             @OA\Property(property="info", type="object",
     *                 @OA\Property(property="count", type="integer", example=50),
     *                 @OA\Property(property="pages", type="integer", example=5),
     *                 @OA\Property(property="next", type="string", nullable=true, example="http://api.test/subcategories?page=2"),
     *                 @OA\Property(property="prev", type="string", nullable=true, example=null)
     *             ),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/SubCategory")),
     *             @OA\Property(property="meta", type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="per_page", type="integer", example=10),
     *                 @OA\Property(property="from", type="integer", example=1),
     *                 @OA\Property(property="to", type="integer", example=10),
     *                 @OA\Property(property="last_page", type="integer", example=5),
     *                 @OA\Property(property="total", type="integer", example=50)
     *             ),
     *             @OA\Property(property="links", type="object",
     *                 @OA\Property(property="first", type="string", example="http://api.test/subcategories?page=1"),
     *                 @OA\Property(property="prev", type="string", nullable=true, example=null),
     *                 @OA\Property(property="next", type="string", nullable=true, example="http://api.test/subcategories?page=2"),
     *                 @OA\Property(property="last", type="string", example="http://api.test/subcategories?page=5")
     *             )
     *         )
     *     )
     * )
*/
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

/**
    * @OA\Post(
        *     path="/subcategories",
        *     summary="Crear una nueva subcategoría",
        *     tags={"SubCategories"},
        *     @OA\RequestBody(
        *         required=true,
        *         @OA\JsonContent(ref="#/components/schemas/StoreSubCategoryRequest")
        *     ),
        *     @OA\Response(
        *         response=201,
        *         description="Subcategoría creada correctamente",
        *         @OA\JsonContent(
        *             @OA\Property(property="status", type="string", example="success"),
        *             @OA\Property(property="color", type="string", example="green"),
        *             @OA\Property(property="message", type="string", example="✅ Se ha creado una nueva sub categoría correctamente."),
        *             @OA\Property(property="data", ref="#/components/schemas/SubCategory")
        *         )
        *     ),
        *     @OA\Response(
        *         response=500,
        *         description="Error al crear subcategoría",
        *         @OA\JsonContent(
        *             @OA\Property(property="status", type="string", example="error"),
        *             @OA\Property(property="color", type="string", example="red"),
        *             @OA\Property(property="message", type="string", example="❌ No se pudo crear una nueva sub categoría.")
        *         )
        *     )
        * )
*/
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

/**
    * @OA\Get(
    *     path="/subcategories/{id}",
    *     summary="Mostrar subcategoría específica",
    *     tags={"SubCategories"},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID de la subcategoría",
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Parameter(
    *         name="includeWords",
    *         in="query",
    *         required=false,
    *         description="Incluir palabras asociadas",
    *         @OA\Schema(type="boolean", example=true)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Detalle de subcategoría",
    *         @OA\JsonContent(ref="#/components/schemas/SubCategory")
    *     )
    * )
*/
    public function show(SubCategory $subcategory){
        $includeWords = request()->query('includeWords');

        if($includeWords){
            return new SubCategoryResource($subcategory->loadMissing('words'));
        }

        return new SubCategoryResource($subcategory);
    }

/**
    * @OA\Put(
    *     path="/subcategories/{id}",
    *     summary="Actualizar una subcategoría",
    *     tags={"SubCategories"},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID de la subcategoría",
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(ref="#/components/schemas/UpdateSubCategoryRequest")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Subcategoría actualizada correctamente",
    *         @OA\JsonContent(
    *             @OA\Property(property="status", type="string", example="success"),
    *             @OA\Property(property="color", type="string", example="green"),
    *             @OA\Property(property="message", type="string", example="✅ sub categoría actualizada correctamente."),
    *             @OA\Property(property="data", ref="#/components/schemas/SubCategory")
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Error al actualizar subcategoría",
    *         @OA\JsonContent(
    *             @OA\Property(property="status", type="string", example="error"),
    *             @OA\Property(property="color", type="string", example="red"),
    *             @OA\Property(property="message", type="string", example="❌ No se pudo actualizar la sub categoría.")
    *         )
    *     )
    * )
*/
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

/**
    * @OA\Delete(
    *     path="/subcategories/{id}",
    *     summary="Eliminar una subcategoría",
    *     tags={"SubCategories"},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID de la subcategoría",
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Subcategoría eliminada correctamente",
    *         @OA\JsonContent(
    *             @OA\Property(property="status", type="string", example="success"),
    *             @OA\Property(property="color", type="string", example="green"),
    *             @OA\Property(property="message", type="string", example="✅ La sub categoria se ha eliminado exitosamente"),
    *             @OA\Property(property="data", ref="#/components/schemas/SubCategory")
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Error al eliminar subcategoría",
    *         @OA\JsonContent(
    *             @OA\Property(property="status", type="string", example="error"),
    *             @OA\Property(property="color", type="string", example="red"),
    *             @OA\Property(property="message", type="string", example="❌ No se pudo eliminar la sub categoria")
    *         )
    *     )
    * )
*/
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
