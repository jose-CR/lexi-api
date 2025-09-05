<?php

namespace App\Http\Controllers;

use App\Filters\WordFilter;
use App\Http\Requests\Api\BulkWordRequest;
use App\Http\Requests\Api\StoreWordRequest;
use App\Http\Requests\Api\UpdateWordRequest;
use App\Http\Resources\WordResource;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WordController extends Controller
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

    public function index(Request $request){
        $filter = new WordFilter();

        $queryItems = $filter->transform($request);

        $words = Word::where($queryItems);

        $word = $words->orderBy('id');

        $wordsPaginated = $word->paginate()->appends($request->query());

        return response()->json([
            'info' => [
                'count' => $wordsPaginated->total(),
                'pages' => $wordsPaginated->lastPage(),
                'next' => $wordsPaginated->nextPageUrl(),
                'prev' => $wordsPaginated->previousPageUrl(),
            ],

            'data' => WordResource::collection($wordsPaginated),

            'meta' => [
                'current_page' => $wordsPaginated->currentPage(),
                'per_page' => $wordsPaginated->perPage(),
                'from' => $wordsPaginated->firstItem(),
                'to' => $wordsPaginated->lastItem(),
                'last_page' => $wordsPaginated->lastPage(),
                'total' => $wordsPaginated->total()
            ],

            'links' => [
                'first' => $wordsPaginated->url(1),
                'prev' => $wordsPaginated->previousPageUrl(),
                'next' => $wordsPaginated->nextPageUrl(),
                'last' => $wordsPaginated->url($wordsPaginated->lastPage()),
            ],
        ]);
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

    public function store(StoreWordRequest $request){
        $word = Word::create($request->all());

        if(!$word){
            return response()->json([
                'status' => 'error',
                'color' => 'red',
                'message' => '❌ No se pudo crear una nueva palabra.',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'color' => 'green',
            'message' => '✅ Se ha creado una nueva palabra correctamente.',
            'data' => new WordResource($word)
        ], 201);
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

    public function bulkStore(BulkWordRequest $request){
        $words = collect($request->validated())->map(function ($word) {
            $word['definition'] = json_encode($word['definition']);
    
            // Renombrar campos correctamente
            $word['sub_category_id'] = $word['subCategoryId'] ?? null;
            $word['spanish_sentence'] = $word['spanishSentence'] ?? null;
    
            // Remover las claves no usadas en DB
            return Arr::except($word, ['subCategoryId', 'spanishSentence']);
        });
    
        Word::insert($words->toArray());
    
        return response()->json([
            'status' => 'success',
            'color' => 'green',
            'message' => '✅ Palabras insertadas correctamente.',
            'inserted' => $words->count(),
        ]);
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

    public function show(Word $word){
        return new WordResource($word);
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

    public function update(UpdateWordRequest $request, Word $word){
        $data = $request->validated();
    
        // Si definition aún es array, conviértela a json
        if (isset($data['definition']) && is_array($data['definition'])) {
            $data['definition'] = json_encode($data['definition']);
        }
    
        $updated = $word->update($data);
    
        if (!$updated) {
            return response()->json([
                'status' => 'error',
                'color' => 'red',
                'message' => '❌ No se pudo actualizar la palabra.',
            ], 500);
        }
    
        return response()->json([
            'status' => 'success',
            'color' => 'green',
            'message' => '✅ Palabra actualizada correctamente.',
            'data' => new WordResource($word)
        ], 200);
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

    public function destroy(Word $word){
        $deleted = $word->delete();

        if(!$deleted){
            return response()->json([
                'status' => 'error',
                'color' => 'red',
                'message' => "❌ No se pudo eliminar la palabra"
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'color' => 'green',
            'message' => "✅ La palabra se ha eliminado exitosamente",
            'data' => new WordResource($word)
        ], 200);

    }
}
