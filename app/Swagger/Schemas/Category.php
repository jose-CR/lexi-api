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
    public function indexInfo()
    {

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
    public function storeInfo()
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
    public function updateInfo()
    {

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
    public function destroyInfo()
    {

    }
}



