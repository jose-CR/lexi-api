<?php

namespace App\Http\Controllers\admin\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreWordRequest;
use App\Http\Requests\Api\UpdateWordRequest;
use App\Models\SubCategory;
use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function create(){
        $subCategories = SubCategory::with('category')->get();

        $uniqueLetters = Word::select('letter')->distinct()->pluck('letter');

        return view('admin.pages.create.word-create', [
            'subCategories' => $subCategories,
            'uniqueLetters' => $uniqueLetters
        ]);
    }

    public function store(StoreWordRequest $request){
        $validated = $request->validated();

        Word::create([
            'sub_category_id' => $validated['subCategoryId'],
            'letter' => strtoupper($validated['letter']),
            'word' => ucfirst($validated['word']),
            'definition' => array_map('trim', explode(',', $validated['definition'])),
            'sentence' => $validated['sentence'],
            'spanish_sentence' => $validated['spanishSentence'],
        ]);

        return redirect()->route('word')->with('success', '✅ Palabra creada con éxito.');
    }

    public function editShow($id){
        $word = Word::findOrFail($id);

        #rango de la a a la z 
        $uniqueLetters = Word::select('letter')->distinct()->orderBy('letter', 'asc')->pluck('letter');

        return view('admin.pages.edit.word-edit', [
            'word' => $word,
            'uniqueLetters' => $uniqueLetters
        ]);
    }

    public function update(UpdateWordRequest $request, $id){
        $validated = $request->validated();
    
        $word = Word::findOrFail($id);
    
        $updates = [];
    
        if (array_key_exists('sub_category_id', $validated)) {
            $updates['sub_category_id'] = $validated['sub_category_id'];
        }
    
        if (array_key_exists('letter', $validated)) {
            $updates['letter'] = strtoupper($validated['letter']);
        }
    
        if (array_key_exists('word', $validated)) {
            $updates['word'] = ucfirst($validated['word']);
        }
    
        if (array_key_exists('definition', $validated)) {
            if (is_string($validated['definition'])) {
                $updates['definition'] = array_map('trim', explode(',', $validated['definition']));
            } else {
                $updates['definition'] = $validated['definition'];
            }
        }
    
        if (array_key_exists('sentence', $validated)) {
            $updates['sentence'] = $validated['sentence'];
        }
    
        if (array_key_exists('spanish_sentence', $validated)) {
            $updates['spanish_sentence'] = $validated['spanish_sentence'];
        }
    
        $word->update($updates);
    
        return redirect()->route('word')->with('success', '✅ Palabra actualizada correctamente.');
    }
    
    public function destroy($id){
        $word = Word::findOrFail($id);
        $word->delete();
        return redirect()->route('word')->with('success', '✅ Palabra eliminada correctamente.');
    }
}