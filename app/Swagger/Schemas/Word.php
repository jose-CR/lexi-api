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
     *     summary="Listar todas las palabras",
     *     description="Devuelve un listado paginado de palabras. Permite aplicar filtros definidos en el WordFilter (por ejemplo, subCategoryId, letra, palabra, etc.).",
     *     operationId="getWords",
     *     tags={"Words"},
     *
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
     *         description="✅ Lista de palabras obtenida correctamente.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="color", type="string", example="green"),
     *             @OA\Property(property="message", type="string", example="✅ Lista de palabras obtenida correctamente."),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="info",
     *                     type="object",
     *                     @OA\Property(property="count", type="integer", example=300),
     *                     @OA\Property(property="pages", type="integer", example=20),
     *                     @OA\Property(property="next", type="string", nullable=true, example="http://localhost:8000/api/v1/words?page=2"),
     *                     @OA\Property(property="prev", type="string", nullable=true, example=null)
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=7),
     *                         @OA\Property(property="subCategoryId", type="integer", example=1),
     *                         @OA\Property(property="letter", type="string", example="M"),
     *                         @OA\Property(property="word", type="string", example="Rerum"),
     *                         @OA\Property(property="definition", type="array",
     *                             @OA\Items(type="string", example="suscipit")
     *                         ),
     *                         @OA\Property(property="sentence", type="string", example="Reprehenderit tempora vitae deserunt qui quis soluta."),
     *                         @OA\Property(property="spanishSentence", type="string", example="Rem qui ut qui omnis."),
     *                         @OA\Property(
     *                             property="times",
     *                             type="object",
     *                             nullable=true,
     *                             @OA\Property(
     *                                 property="pasado",
     *                                 type="object",
     *                                 @OA\Property(property="definition", type="string", example="porro, incidunt, est"),
     *                                 @OA\Property(property="sentence", type="string", example="Est facere non exercitationem quia rerum."),
     *                                 @OA\Property(property="spanishSentence", type="string", example="Quo consequuntur et soluta libero dolore.")
     *                             ),
     *                             @OA\Property(
     *                                 property="ing",
     *                                 type="object",
     *                                 @OA\Property(property="definition", type="string", example="dolor, quis, quas"),
     *                                 @OA\Property(property="sentence", type="string", example="Et voluptatem ea voluptatibus eos repellendus."),
     *                                 @OA\Property(property="spanishSentence", type="string", example="Quo reprehenderit facilis quis ipsa dolorem.")
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
     *                     @OA\Property(property="last_page", type="integer", example=20),
     *                     @OA\Property(property="total", type="integer", example=300)
     *                 ),
     *                 @OA\Property(
     *                     property="links",
     *                     type="object",
     *                     @OA\Property(property="first", type="string", example="http://localhost:8000/api/v1/words?page=1"),
     *                     @OA\Property(property="prev", type="string", nullable=true, example=null),
     *                     @OA\Property(property="next", type="string", nullable=true, example="http://localhost:8000/api/v1/words?page=2"),
     *                     @OA\Property(property="last", type="string", example="http://localhost:8000/api/v1/words?page=20")
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="❌ Error al obtener las palabras.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="color", type="string", example="red"),
     *             @OA\Property(property="message", type="string", example="❌ Error al obtener las palabras."),
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
     *     path="/words/{id}",
     *     summary="Obtener una palabra específica",
     *     description="Devuelve los detalles de una palabra específica según su ID.",
     *     operationId="getWordById",
     *     tags={"Words"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la palabra que se desea obtener",
     *         @OA\Schema(type="integer", example=7)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="✅ Palabra obtenida correctamente.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="color", type="string", example="green"),
     *             @OA\Property(property="message", type="string", example="✅ Palabra obtenida correctamente."),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=7),
     *                 @OA\Property(property="subCategoryId", type="integer", example=1),
     *                 @OA\Property(property="letter", type="string", example="M"),
     *                 @OA\Property(property="word", type="string", example="Rerum"),
     *                 @OA\Property(property="definition", type="array",
     *                     @OA\Items(type="string", example="suscipit")
     *                 ),
     *                 @OA\Property(property="sentence", type="string", example="Reprehenderit tempora vitae deserunt qui quis soluta."),
     *                 @OA\Property(property="spanishSentence", type="string", example="Rem qui ut qui omnis."),
     *                 @OA\Property(
     *                     property="times",
     *                     type="object",
     *                     nullable=true,
     *                     @OA\Property(
     *                         property="pasado",
     *                         type="object",
     *                         @OA\Property(property="definition", type="string", example="porro, incidunt, est"),
     *                         @OA\Property(property="sentence", type="string", example="Est facere non exercitationem quia rerum."),
     *                         @OA\Property(property="spanishSentence", type="string", example="Quo consequuntur et soluta libero dolore.")
     *                     ),
     *                     @OA\Property(
     *                         property="ing",
     *                         type="object",
     *                         @OA\Property(property="definition", type="string", example="dolor, quis, quas"),
     *                         @OA\Property(property="sentence", type="string", example="Et voluptatem ea voluptatibus eos repellendus."),
     *                         @OA\Property(property="spanishSentence", type="string", example="Quo reprehenderit facilis quis ipsa dolorem.")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="❌ Palabra no encontrada.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="color", type="string", example="red"),
     *             @OA\Property(property="message", type="string", example="❌ Palabra no encontrada.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="❌ Error interno al obtener la palabra.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="color", type="string", example="red"),
     *             @OA\Property(property="message", type="string", example="❌ No se pudo obtener la palabra."),
     *             @OA\Property(property="error", type="string", example="Detalles del error o excepción.")
     *         )
     *     )
     * )
     */

    public function showInfo()
    {

    }
}
