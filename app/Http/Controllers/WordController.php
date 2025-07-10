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
    

    public function show(Word $word){
        return new WordResource($word);
    }

    public function update(UpdateWordRequest $request, Word $word){
        $updated = $word->update($request->only([
            'sub_category_id',
            'letter',
            'word',
            'definition',
            'sentence',
            'spanish_sentence'
        ]));
    
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
