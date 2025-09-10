<?php

namespace App\Swagger\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SubCategory",
 *     title="SubCategory",
 *     description="Modelo de SubCategory",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="category_id", type="integer", example=2),
 *     @OA\Property(property="subcategory", type="string", example="Animales"),
 *     @OA\Property(
 *         property="category",
 *         ref="#/components/schemas/Category",
 *         nullable=true
 *     ),
 *     @OA\Property(
 *         property="words",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Word"),
 *         description="Lista de palabras relacionadas"
 *     ),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-05T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-05T12:00:00Z")
 * )
*/
class SubCategory
{
    
}

class SubCategoryController
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
    public function indexInfo()
    {

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
    public function storeInfo()
    {

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
    public function showInfo()
    {

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
    public function updateInfo()
    {

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
    public function destroyInfo()
    {

    }
}

/**
 * @OA\Schema(
 *     schema="StoreSubCategoryRequest",
 *     title="Store SubCategory Request",
 *     description="Datos necesarios para crear una subcategoría",
 *     required={"subCategory"},
 *     @OA\Property(
 *         property="categoryId",
 *         type="integer",
 *         nullable=true,
 *         example=2,
 *         description="ID de la categoría padre (opcional)"
 *     ),
 *     @OA\Property(
 *         property="subCategory",
 *         type="string",
 *         example="Animales",
 *         description="Nombre de la subcategoría"
 *     )
 * )
 */
class StoreSubCategoryRequest
{

}

/**
 * @OA\Schema(
 *     schema="UpdateSubCategoryRequest",
 *     title="Update SubCategory Request",
 *     description="Datos para actualizar una subcategoría",
 *     @OA\Property(
 *         property="categoryId",
 *         type="integer",
 *         nullable=true,
 *         example=3,
 *         description="ID de la categoría padre (opcional)"
 *     ),
 *     @OA\Property(
 *         property="subCategory",
 *         type="string",
 *         example="Animales Domésticos",
 *         description="Nombre actualizado de la subcategoría"
 *     )
 * )
 */
class UpdateSubCategoryRequest
{

}
