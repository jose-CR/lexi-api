<?php

use App\Http\Controllers\admin\frontend\CategoryController;
use App\Http\Controllers\admin\frontend\SubCategoryController;
use App\Http\Controllers\admin\frontend\WordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

# RUTAS DE VISTAS ADMINISTRATIVAS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('category', 'admin/category')->name('category');
    Route::view('subcategory', 'admin/subcategory')->name('subcategory');
    Route::view('word', 'admin/word')->name('word');
});

# RUTAS DE CRUD ADMINISTRATIVO
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Category Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('category')->group(function () {
        Route::view('create', 'admin/pages/create/category-create')->name('category-create');

        Route::post('store', [CategoryController::class, 'store'])->name('category.store');

        Route::get('edit/{id}', [CategoryController::class, 'editShow'])->name('category-edit');
        Route::put('edit/{id}', [CategoryController::class, 'update'])->name('category.edit');

        Route::delete('delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Subcategory Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('subcategory')->group(function () {
        Route::get('create', [SubCategoryController::class, 'create'])->name('subcategory-create');

        Route::post('store', [SubCategoryController::class, 'store'])->name('subcategory.store');

        Route::get('edit/{id}', [SubCategoryController::class, 'editShow'])->name('subcategory-edit');
        Route::put('edit/{id}', [SubCategoryController::class, 'update'])->name('subcategory.edit');

        Route::delete('delete/{subcategory}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Word Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('word')->group(function (){
        Route::get('create', [WordController::class, 'create'])->name('word-create');

        Route::post('store', [WordController::class, 'store'])->name('word.store');

        Route::get('edit/{id}', [WordController::class, 'editShow'])->name('word-edit');
        Route::patch('edit/{id}', [WordController::class, 'update'])->name('word.edit');

        Route::delete('delete/{word}', [WordController::class, 'destroy'])->name('word.destroy');
    });
});

require __DIR__.'/auth.php';