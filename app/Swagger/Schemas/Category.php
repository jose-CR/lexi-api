<?php

namespace App\Swagger\Schemas;

use OpenApi\Annotations as OA;

/**
    * @OA\Schema(
    *     schema="Category",
    *     type="object",
    *     title="Category",
    *     required={"id","name"},
    *     @OA\Property(property="id", type="integer", example=1),
    *     @OA\Property(property="name", type="string", example="Ejemplo"),
    *     @OA\Property(property="subcategories", type="array",
    *         @OA\Items(ref="#/components/schemas/Category")
    *     )
    * )
*/
class Category
{

}

class CategoryController
{
    /**
     * @OA\Get(
     *     path="/categories",
     *     summary="Listar todas las categorías",
     *     description="Obtiene un listado paginado de categorías. Permite incluir subcategorías y aplicar filtros.",
     *     operationId="getCategories",
     *     tags={"Categories"},
     * 
     *     @OA\Parameter(
     *         name="includeSubCategories",
     *         in="query",
     *         description="Incluir subcategorías en la respuesta (true o false)",
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
     *         description="✅ Lista de categorías obtenida correctamente.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="color", type="string", example="green"),
     *             @OA\Property(property="message", type="string", example="✅ Lista de categorías obtenida correctamente."),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="info",
     *                     type="object",
     *                     @OA\Property(property="count", type="integer", example=6),
     *                     @OA\Property(property="pages", type="integer", example=1),
     *                     @OA\Property(property="next", type="string", nullable=true, example=null),
     *                     @OA\Property(property="prev", type="string", nullable=true, example=null)
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="category", type="string", example="ingles")
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="meta",
     *                     type="object",
     *                     @OA\Property(property="current_page", type="integer", example=1),
     *                     @OA\Property(property="per_page", type="integer", example=15),
     *                     @OA\Property(property="from", type="integer", example=1),
     *                     @OA\Property(property="to", type="integer", example=6),
     *                     @OA\Property(property="last_page", type="integer", example=1),
     *                     @OA\Property(property="total", type="integer", example=6)
     *                 ),
     *                 @OA\Property(
     *                     property="links",
     *                     type="object",
     *                     @OA\Property(property="first", type="string", example="http://localhost:8000/api/v1/categories?page=1"),
     *                     @OA\Property(property="prev", type="string", nullable=true, example=null),
     *                     @OA\Property(property="next", type="string", nullable=true, example=null),
     *                     @OA\Property(property="last", type="string", example="http://localhost:8000/api/v1/categories?page=1")
     *                 )
     *             )
     *         )
     *     ),
     * 
     *     @OA\Response(
     *         response=500,
     *         description="❌ Error al obtener las categorías.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="color", type="string", example="red"),
     *             @OA\Property(property="message", type="string", example="❌ Error al obtener las categorías."),
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
         *     path="/categories/{id}",
         *     summary="Obtener una categoría por su ID",
         *     description="Devuelve los detalles de una categoría específica. Se puede incluir opcionalmente la lista de subcategorías relacionadas.",
         *     operationId="getCategoryById",
         *     tags={"Categories"},
         *
         *     @OA\Parameter(
         *         name="id",
         *         in="path",
         *         required=true,
         *         description="ID numérico de la categoría a consultar",
         *         @OA\Schema(type="integer", example=1)
         *     ),
         *     @OA\Parameter(
         *         name="includeSubCategories",
         *         in="query",
         *         description="Incluir subcategorías asociadas a la categoría",
         *         required=false,
         *         @OA\Schema(type="boolean", example=true)
         *     ),
         *
         *     @OA\Response(
         *         response=200,
         *         description="✅ Categoría obtenida correctamente.",
         *         @OA\JsonContent(
         *             type="object",
         *             @OA\Property(property="status", type="string", example="success"),
         *             @OA\Property(property="color", type="string", example="green"),
         *             @OA\Property(property="message", type="string", example="✅ Categoría obtenida correctamente."),
         *             @OA\Property(
         *                 property="data",
         *                 type="object",
         *                 @OA\Property(property="id", type="integer", example=1),
         *                 @OA\Property(property="category", type="string", example="ingles"),
         *                 @OA\Property(
         *                     property="subcategories",
         *                     type="array",
         *                     nullable=true,
         *                     description="Lista de subcategorías si se incluye con includeSubCategories=true",
         *                     @OA\Items(
         *                         type="object",
         *                         @OA\Property(property="id", type="integer", example=10),
         *                         @OA\Property(property="subcategory", type="string", example="vocabulario básico")
         *                     )
         *                 )
         *             )
         *         )
         *     ),
         *
         *     @OA\Response(
         *         response=404,
         *         description="❌ Categoría no encontrada.",
         *         @OA\JsonContent(
         *             type="object",
         *             @OA\Property(property="status", type="string", example="error"),
         *             @OA\Property(property="color", type="string", example="red"),
         *             @OA\Property(property="message", type="string", example="❌ No se pudo obtener la categoría."),
         *             @OA\Property(property="error", type="string", example="No query results for model [App\\Models\\Category] 999")
         *         )
         *     ),
         *
         *     @OA\Response(
         *         response=500,
         *         description="❌ Error interno al obtener la categoría.",
         *         @OA\JsonContent(
         *             type="object",
         *             @OA\Property(property="status", type="string", example="error"),
         *             @OA\Property(property="color", type="string", example="red"),
         *             @OA\Property(property="message", type="string", example="❌ No se pudo obtener la categoría."),
         *             @OA\Property(property="error", type="string", example="Detalles de la excepción.")
         *         )
         *     )
         * )
         */
    public function showInfo()
    {

    }
}