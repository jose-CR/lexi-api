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
}
