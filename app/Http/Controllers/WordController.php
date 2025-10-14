<?php

namespace App\Http\Controllers;

use App\Filters\WordFilter;
use App\Http\Requests\Api\BulkWordRequest;
use App\Http\Requests\Api\StoreWordRequest;
use App\Http\Requests\Api\UpdateWordRequest;
use App\Http\Resources\WordResource;
use App\Models\Word;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WordController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request){
        try{
            $filter = new WordFilter();

            $queryItems = $filter->transform($request);
    
            $words = Word::where($queryItems);
    
            $word = $words->orderBy('id');
    
            $wordsPaginated = $word->paginate()->appends($request->query());

            return $this->paginatedResponse(
                $wordsPaginated->through(fn($word) => new WordResource($word)),
                '✅ Lista de palabras obtenida correctamente.'
            );
        }catch(Exception $e){
            return $this->exceptionResponse($e, '❌ Error al obtener las palabras.');
        }
    }

    public function store(StoreWordRequest $request){
        try{
            $word = Word::create($request->validated());

            return $this->successResponse(
                '✅ palabra creada correctamente.',
                new WordResource($word),
                201
            );
        }catch(Exception $e){
            return $this->errorResponse($e, '❌ No se pudo crear la Palabra.');
        }
    }
    
    public function bulkStore(BulkWordRequest $request){
        try {
            $words = collect($request->validated())->map(function ($word) {
                $word['definition'] = json_encode($word['definition']);
        
                // Normalizar nombres de campos
                $word['sub_category_id'] = $word['subCategoryId'] ?? null;
                $word['spanish_sentence'] = $word['spanishSentence'] ?? null;
        
                // Limpiar claves que no van a DB
                return Arr::except($word, ['subCategoryId', 'spanishSentence']);
            });
    
            Word::insert($words->toArray());
    
            return $this->successResponse(
                '✅ Palabras creadas correctamente.',
                ['inserted' => $words->count()],
                201
            );
    
        } catch (Exception $e) {
            return $this->exceptionResponse($e, '❌ No se pudieron crear las palabras.');
        }
    }    
    
    public function show(Word $word){
        try
        {
            return new WordResource($word);
        }catch(Exception $e){
            return $this->exceptionResponse($e, '❌ No se pudo obtener la sub categoría.');
        }
    }

    public function update(UpdateWordRequest $request, Word $word){
        try
        {
            $data = $request->validated();

            if (isset($data['definition']) && is_array($data['definition'])) {
                $data['definition'] = json_encode($data['definition']);
            }

            $updated = $word->update($data);

            if(!$updated){
                return $this->errorResponse('❌ No se pudo actualizar la palabra.');
            }

            return $this->successResponse(
                '✅ palabra actualizada correctamente.',
                new WordResource($word)
            );
        }catch(Exception $e){
            return $this->errorResponse($e, '❌ Error al actualizar la palabra.');
        }    
    }

    public function destroy(Word $word){
        try{
            $deleted = $word->delete();

            if(!$deleted){
                return $this->errorResponse('❌ No se pudo eliminar la palabra.');
            }

            return $this->successResponse(
                '✅ La palabra se ha eliminado exitosamente.',
                new WordResource($word)
            );
        }catch(Exception $e){
            return $this->exceptionResponse($e, '❌ Error al eliminar la palabra.');
        }
    }
}