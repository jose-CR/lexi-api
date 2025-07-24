<?php

use App\Http\Controllers\admin\frontend\CategoryController;
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

#rutas para las vistas administrativas de la API
Route::view('category', 'admin/category')
    ->middleware(['auth', 'verified'])
    ->name('category');

Route::view('subcategory', 'admin/subcategory')
    ->middleware(['auth', 'verified'])
    ->name('subcategory');

#-------------------------------------------------------
#Rutas para el CRUD de vistas
Route::group(['middleware' => ['verified', 'auth']], function () {
    # category
    Route::view('category/create', 'admin/pages/create/category-create')
    ->name('category-create');

    Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store');

    Route::get('category/edit/{id}', [CategoryController::class, 'editShow'])->name('category-edit');

    Route::put('/categories/edit/{id}', [CategoryController::class, 'update'])->name('category.edit');

    Route::delete('/categories/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    #------------------------------------------------------------------------------------------------
});

require __DIR__.'/auth.php';