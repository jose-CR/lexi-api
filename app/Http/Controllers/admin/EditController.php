<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function updatecategory($id){
        $category = Category::findOrFail($id);
        return view('admin.pages.edit.category-edit', compact('category'));
    }

}