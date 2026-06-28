<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\User;

class AdminController extends Controller
{
    // Halaman dashboard admin
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalRecipes = Recipe::count();
        $totalBookmarked = Recipe::where('is_bookmarked', true)->count();

        return view('admin.dashboard', compact('totalUsers', 'totalRecipes', 'totalBookmarked'));
    }

    // Daftar semua resep dari semua user
    public function recipesIndex()
    {
        $recipes = Recipe::with('user')->latest()->get();

        return view('admin.recipes.index', compact('recipes'));
    }

    // Lihat detail satu resep (admin)
    public function recipesShow(Recipe $recipe)
    {
        return view('admin.recipes.show', compact('recipe'));
    }

    // Hapus resep (admin bisa moderasi)
    public function recipesDestroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('admin.recipes.index')->with('success', 'Resep berhasil dihapus.');
    }
}