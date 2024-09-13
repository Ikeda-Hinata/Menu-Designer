<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\RecipesController;

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

Route::get('/meals/create', [MealsController::class, 'create'])->name('meals.create');
Route::post('/meals', [MealsController::class, 'store'])->name('meals.store');
Route::get('/meals/show',[MealsController::class,'show'])->name('meals.show');
Route::get('/meals/menuList',[MealsController::class,'menuList'])->name('meals.menuList');
Route::get('/meals/menuDetail/{id}',[MealsController::class,'menuDetail'])->name('meals.menuDetail');

Route::get('',[RecipesController::class,'recipeList'])->name('recipes.recipeList');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/recipes/create',[RecipesController::class,'create'])->name('recipes.create');
Route::post('/recipes',[RecipesController::class,'store'])->name('recipes.store');
Route::get('recipes/show',[RecipesController::class,'show'])->name('recipes.show');
Route::get('/recipes/search', [RecipesController::class, 'search'])->name('recipes.search');
Route::get('/recipes/{id}', [RecipesController::class, 'recipeDetail'])->name('recipes.recipeDetail');
Route::post('/recipes/{id}/comments', [RecipesController::class, 'storeComment'])->name('recipes.storeComment');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';