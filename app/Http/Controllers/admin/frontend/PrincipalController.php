<?php

namespace App\Http\Controllers\admin\frontend;

use App\Http\Controllers\Controller;

class PrincipalController extends Controller
{
    public function principal()
    {
        return response()->json([
            'categories' => route('categories.index'),
            'sucategories' => route('subcategories.index'),
            'words' => route('words.index')
        ]);
    }
}
