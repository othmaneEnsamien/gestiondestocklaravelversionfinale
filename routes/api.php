<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'storeCategory'])->name('categories.store');
Route::post('/subcategories', [CategoryController::class, 'storeSubCategory'])->name('subcategories.store');
Route::post('categories/subcategories/detach', [CategoryController::class, 'detachSubCategory'])->name('categories.subcategories.detach');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
