<?php

namespace App\Http\Controllers\admin\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreSubCategoryRequest;
use App\Http\Requests\Api\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function create(){
        $categories = Category::all();
        return view('admin.pages.create.subcategory-create', compact('categories'));
    }

    public function store(StoreSubCategoryRequest $request){
        $validated = $request->validated();
    
        $subcategory = SubCategory::create([
            'subcategory' => $validated['subCategory'],
            'category_id' => $validated['categoryId'] ?? null,
        ]);
    
        if (!$subcategory) {
            return back()->with('error', '❌ No se pudo crear la subcategoría.');
        }
    
        return redirect()->route('subcategory')->with('success', '✅ SubCategoría creada correctamente.');
    }

    public function editShow($id){
        $subcategory = SubCategory::findOrFail($id);

        return view('admin.pages.edit.subcategory-edit', compact('subcategory'));
    }

    public function update(UpdateSubCategoryRequest $request, $id){
        $validated = $request->validated();
    
        $subcategory = SubCategory::findOrFail($id);
    
        $updates = [];
    
        if (array_key_exists('subCategory', $validated)) {
            $updates['subcategory'] = $validated['subCategory'];
        }
    
        if (array_key_exists('categoryId', $validated)) {
            $updates['category_id'] = $validated['categoryId'];
        }
    
        $subcategory->update($updates);
    
        return redirect()->route('subcategory')->with('success', '✅ Subcategoría actualizada correctamente.');
    }

    public function destroy($id){
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->route('subcategory')->with('success', '✅ Categoría eliminada correctamente.');
    }
}
