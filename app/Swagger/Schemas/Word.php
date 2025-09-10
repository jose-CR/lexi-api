<?php

namespace App\Swagger\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Word",
 *     title="Word",
 *     description="Modelo de palabras asociadas a una subcategoría",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="sub_category_id", type="integer", example=2),
 *     @OA\Property(property="letter", type="string", maxLength=1, example="A"),
 *     @OA\Property(property="word", type="string", example="Apple"),
 *     @OA\Property(
 *         property="definition",
 *         type="array",
 *         @OA\Items(type="string"),
 *         example={"A fruit", "A tech company"}
 *     ),
 *     @OA\Property(property="spanish_sentence", type="string", example="La manzana es una fruta."),
 *     @OA\Property(property="sentence", type="string", example="Apple is a leading tech company."),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-05T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-05T12:00:00Z")
 * )
*/
class Word
{

}

/**
     * @OA\Schema(
     *     schema="StoreWordRequest",
     *     title="Store Word Request",
     *     description="Datos necesarios para crear una palabra",
     *     required={"subCategoryId", "letter", "word", "definition", "spanishSentence", "sentence"},
     *     @OA\Property(
     *         property="subCategoryId",
     *         type="integer",
     *         example=5,
     *         description="ID de la subcategoría asociada"
     *     ),
     *     @OA\Property(
     *         property="letter",
     *         type="string",
     *         example="A",
     *         description="Letra inicial de la palabra"
     *     ),
     *     @OA\Property(
     *         property="word",
     *         type="string",
     *         example="Árbol",
     *         description="Palabra registrada"
     *     ),
     *     @OA\Property(
     *         property="definition",
     *         type="string",
     *         example="Planta perenne con tallo leñoso que se ramifica a cierta altura del suelo.",
     *         description="Definición de la palabra"
     *     ),
     *     @OA\Property(
     *         property="spanishSentence",
     *         type="string",
     *         example="El árbol da sombra en verano.",
     *         description="Oración en español con la palabra"
     *     ),
     *     @OA\Property(
     *         property="sentence",
     *         type="string",
     *         example="The tree gives shade in summer.",
     *         description="Oración en otro idioma con la palabra"
     *     )
     * )
     */
class StoreWordRequest
{

}

/**
     * @OA\Schema(
     *     schema="BulkWordRequest",
     *     title="Bulk Word Request",
     *     description="Lista de palabras a crear en una sola petición",
     *     type="array",
     *     @OA\Items(
     *         type="object",
     *         required={"letter", "word", "definition", "sentence", "spanishSentence"},
     *         @OA\Property(
     *             property="subCategoryId",
     *             type="integer",
     *             nullable=true,
     *             example=3,
     *             description="ID de la subcategoría asociada (opcional)"
     *         ),
     *         @OA\Property(
     *             property="letter",
     *             type="string",
     *             example="C",
     *             description="Letra inicial de la palabra"
     *         ),
     *         @OA\Property(
     *             property="word",
     *             type="string",
     *             example="Casa",
     *             description="Palabra registrada"
     *         ),
     *         @OA\Property(
     *             property="definition",
     *             type="array",
     *             @OA\Items(type="string"),
     *             example={"Lugar para habitar", "Edificación destinada a vivienda"},
     *             description="Definición de la palabra (array de definiciones)"
     *         ),
     *         @OA\Property(
     *             property="sentence",
     *             type="string",
     *             example="The house is big.",
     *             description="Oración en otro idioma con la palabra"
     *         ),
     *         @OA\Property(
     *             property="spanishSentence",
     *             type="string",
     *             example="La casa es grande.",
     *             description="Oración en español con la palabra"
     *         )
     *     )
     * )
*/
class BulkWordRequest
{

}

/**
     * @OA\Schema(
     *     schema="UpdateWordRequest",
     *     title="Update Word Request",
     *     description="Datos permitidos para actualizar una palabra",
     *     @OA\Property(
     *         property="subCategoryId",
     *         type="integer",
     *         nullable=true,
     *         example=5,
     *         description="ID de la subcategoría asociada (opcional)"
     *     ),
     *     @OA\Property(
     *         property="letter",
     *         type="string",
     *         example="B",
     *         description="Letra inicial de la palabra"
     *     ),
     *     @OA\Property(
     *         property="word",
     *         type="string",
     *         example="Barco",
     *         description="Palabra registrada"
     *     ),
     *     @OA\Property(
     *         property="definition",
     *         type="string",
     *         example="Embarcación de gran tamaño destinada a navegar.",
     *         description="Definición de la palabra"
     *     ),
     *     @OA\Property(
     *         property="sentence",
     *         type="string",
     *         example="The ship sails at dawn.",
     *         description="Oración en otro idioma con la palabra"
     *     ),
     *     @OA\Property(
     *         property="spanishSentence",
     *         type="string",
     *         example="El barco zarpa al amanecer.",
     *         description="Oración en español con la palabra"
     *     )
     * )
     */
class UpdateWordRequest
{

}

class WordController
{
    /**
     * @OA\Get(
     *     path="/words",
     *     summary="Listar palabras",
     *     description="Devuelve un listado paginado de palabras con filtros opcionales.",
     *     tags={"Words"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Número de página",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Listado paginado de palabras",
     *         @OA\JsonContent(
     *             @OA\Property(property="info", type="object",
     *                 @OA\Property(property="count", type="integer", example=100),
     *                 @OA\Property(property="pages", type="integer", example=10),
     *                 @OA\Property(property="next", type="string", nullable=true, example="http://api.test/words?page=2"),
     *                 @OA\Property(property="prev", type="string", nullable=true, example=null)
     *             ),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Word")),
     *             @OA\Property(property="meta", type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="per_page", type="integer", example=15),
     *                 @OA\Property(property="total", type="integer", example=100)
     *             ),
     *             @OA\Property(property="links", type="object",
     *                 @OA\Property(property="first", type="string", example="http://api.test/words?page=1"),
     *                 @OA\Property(property="last", type="string", example="http://api.test/words?page=10"),
     *                 @OA\Property(property="prev", type="string", nullable=true, example=null),
     *                 @OA\Property(property="next", type="string", nullable=true, example="http://api.test/words?page=2")
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
     *     path="/words",
     *     summary="Crear palabra",
     *     description="Crea una nueva palabra en el sistema.",
     *     tags={"Words"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreWordRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Palabra creada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Word")
     *     ),
     *     @OA\Response(response=500, description="Error al crear la palabra")
     * )
     */

    public function store()
    {

    }
    
    /**
     * @OA\Post(
     *     path="/words/bulk",
     *     summary="Insertar palabras en lote",
     *     description="Permite insertar múltiples palabras en una sola petición.",
     *     tags={"Words"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BulkWordRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Palabras insertadas correctamente"
     *     )
     * )
     */

    public function bulkStoreInfo(){
    }
    
    /**
     * @OA\Get(
     *     path="/words/{id}",
     *     summary="Obtener palabra",
     *     description="Devuelve una palabra específica por ID.",
     *     tags={"Words"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la palabra",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalle de la palabra",
     *         @OA\JsonContent(ref="#/components/schemas/Word")
     *     ),
     *     @OA\Response(response=404, description="Palabra no encontrada")
     * )
     */

    public function showInfo()
    {

    }

    /**
     * @OA\Put(
     *     path="/words/{id}",
     *     summary="Actualizar palabra",
     *     description="Actualiza una palabra existente.",
     *     tags={"Words"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la palabra",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateWordRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Palabra actualizada correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/Word")
     *     ),
     *     @OA\Response(response=500, description="Error al actualizar la palabra")
     * )
     */

    public function updateInfo(){
    }

    /**
     * @OA\Delete(
     *     path="/words/{id}",
     *     summary="Eliminar palabra",
     *     description="Elimina una palabra por ID.",
     *     tags={"Words"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la palabra",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Palabra eliminada correctamente"
     *     ),
     *     @OA\Response(response=500, description="Error al eliminar la palabra")
     * )
     */

    public function destroyInfo()
    {

    }
}
