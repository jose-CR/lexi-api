<?php

namespace App\Http\Controllers\admin\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCategoryRequest;
use App\Http\Requests\Api\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(StoreCategoryRequest $request){
        $category = Category::create($request->validated());
    
        if(!$category) {
            return back()->with('error', '❌ No se pudo crear la subcategoría.');
        }
    
        return redirect()->route('category')->with('success', '✅ Categoría creada correctamente.');
    }

    public function editShow($id){
        $category = Category::findOrFail($id);

        return view('admin.pages.edit.category-edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id){
        $category = Category::findOrFail($id);

        $category->update($request->validated());

        return redirect()->route('category')->with('success', '✅ Categoría actualizada correctamente.');
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category')->with('success', '✅ Categoría eliminada correctamente.');
    }
}
