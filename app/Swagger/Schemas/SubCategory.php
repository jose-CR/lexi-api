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
     *     description="Obtiene un listado paginado de subcategorías. Permite incluir palabras relacionadas (includeWords=true).",
     *     operationId="getSubCategories",
     *     tags={"SubCategories"},
     *
     *     @OA\Parameter(
     *         name="includeWords",
     *         in="query",
     *         description="Incluir palabras asociadas a cada subcategoría",
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
     *
     *     @OA\Response(
     *         response=200,
     *         description="✅ Lista de subcategorías obtenida correctamente.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="color", type="string", example="green"),
     *             @OA\Property(property="message", type="string", example="✅ Lista de subcategorías obtenida correctamente."),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="info",
     *                     type="object",
     *                     @OA\Property(property="count", type="integer", example=32),
     *                     @OA\Property(property="pages", type="integer", example=3),
     *                     @OA\Property(property="next", type="string", nullable=true, example="http://localhost:8000/api/v1/subcategories?page=2"),
     *                     @OA\Property(property="prev", type="string", nullable=true, example=null)
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="categoryId", type="integer", example=1),
     *                         @OA\Property(property="subCategory", type="string", example="verbo"),
     *                         @OA\Property(
     *                             property="words",
     *                             type="array",
     *                             nullable=true,
     *                             description="Solo aparece si includeWords=true",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=100),
     *                                 @OA\Property(property="word", type="string", example="run"),
     *                                 @OA\Property(property="translation", type="string", example="correr")
     *                             )
     *                         )
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="meta",
     *                     type="object",
     *                     @OA\Property(property="current_page", type="integer", example=1),
     *                     @OA\Property(property="per_page", type="integer", example=15),
     *                     @OA\Property(property="from", type="integer", example=1),
     *                     @OA\Property(property="to", type="integer", example=15),
     *                     @OA\Property(property="last_page", type="integer", example=3),
     *                     @OA\Property(property="total", type="integer", example=32)
     *                 ),
     *                 @OA\Property(
     *                     property="links",
     *                     type="object",
     *                     @OA\Property(property="first", type="string", example="http://localhost:8000/api/v1/subcategories?page=1"),
     *                     @OA\Property(property="prev", type="string", nullable=true, example=null),
     *                     @OA\Property(property="next", type="string", nullable=true, example="http://localhost:8000/api/v1/subcategories?page=2"),
     *                     @OA\Property(property="last", type="string", example="http://localhost:8000/api/v1/subcategories?page=3")
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="❌ Error al obtener las subcategorías.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="color", type="string", example="red"),
     *             @OA\Property(property="message", type="string", example="❌ Error al obtener las subcategorías."),
     *             @OA\Property(property="error", type="string", example="Detalles del error o excepción.")
     *         )
     *     )
     * )
     */
    public function indexInfo()
    {

    }

    /**
     * @OA\Get(
     *     path="/subcategories/{id}",
     *     summary="Mostrar una subcategoría específica",
     *     description="Obtiene los detalles de una subcategoría por su ID. Si se pasa includeWords=true, incluye las palabras asociadas.",
     *     operationId="getSubCategoryById",
     *     tags={"SubCategories"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la subcategoría",
     *         @OA\Schema(type="integer", example=5)
     *     ),
     *     @OA\Parameter(
     *         name="includeWords",
     *         in="query",
     *         required=false,
     *         description="Incluir palabras asociadas a la subcategoría",
     *         @OA\Schema(type="boolean", example=true)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="✅ Sub categoría obtenida correctamente.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="color", type="string", example="green"),
     *             @OA\Property(property="message", type="string", example="✅ Sub categoría obtenida correctamente."),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=5),
     *                 @OA\Property(property="categoryId", type="integer", example=1),
     *                 @OA\Property(property="subCategory", type="string", example="adjetivo"),
     *                 @OA\Property(
     *                     property="words",
     *                     type="array",
     *                     nullable=true,
     *                     description="Solo aparece si includeWords=true",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=21),
     *                         @OA\Property(property="word", type="string", example="beautiful"),
     *                         @OA\Property(property="translation", type="string", example="hermoso")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="❌ Sub categoría no encontrada.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="color", type="string", example="red"),
     *             @OA\Property(property="message", type="string", example="❌ No se pudo obtener la sub categoría."),
     *             @OA\Property(property="error", type="string", example="No query results for model [App\\Models\\SubCategory] 99")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="❌ Error interno al obtener la sub categoría.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="color", type="string", example="red"),
     *             @OA\Property(property="message", type="string", example="❌ No se pudo obtener la sub categoría."),
     *             @OA\Property(property="error", type="string", example="Detalles del error o excepción.")
     *         )
     *     )
     * )
     */
    public function showInfo()
    {

    }
}