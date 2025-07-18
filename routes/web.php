<?php

use App\Http\Controllers\admin\CreateController;
use App\Http\Controllers\admin\EditController;
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

#Rutas para el CRUD de vistas
Route::group(['middleware' => ['verified', 'auth']], function () {
    # category
    Route::view('category/create', 'admin/pages/create/category-create')
    ->name('category-create');

    Route::get('category/{id}', [EditController::class, 'updatecategory'])->name('category-edit');
    #------------------------------------------------------------------------------------------------
});

require __DIR__.'/auth.php';
