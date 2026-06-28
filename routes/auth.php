<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes/generate', [RecipeController::class, 'generate'])->name('recipes.generate');
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
    Route::patch('/recipes/{recipe}/bookmark', [RecipeController::class, 'bookmark'])->name('recipes.bookmark');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/recipes', [AdminController::class, 'recipesIndex'])->name('recipes.index');
    Route::get('/recipes/{recipe}', [AdminController::class, 'recipesShow'])->name('recipes.show');
    Route::delete('/recipes/{recipe}', [AdminController::class, 'recipesDestroy'])->name('recipes.destroy');
});

require __DIR__.'/auth.php';