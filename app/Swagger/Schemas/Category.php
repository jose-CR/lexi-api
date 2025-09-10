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
    public function indexInfo()
    {

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
    public function showInfo()
    {

    }
}