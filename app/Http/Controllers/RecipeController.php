<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    // Halaman input bahan + checklist
    public function create()
    {
        return view('recipes.create');
    }

    // Generate resep dari Gemini API
    public function generate(Request $request)
    {
        $request->validate([
            'ingredients' => 'required|string|max:1000',
        ]);

        $ingredients = $request->input('ingredients');
        $apiKey = env('GEMINI_API_KEY');

        $prompt = "Buatkan 3 alternatif resep masakan kreatif menggunakan bahan-bahan ini: {$ingredients}. 
        Untuk setiap resep, tuliskan: 1) Nama resep, 2) Bahan-bahan, 3) Langkah-langkah memasak. 
        Format jawaban dalam Markdown dengan heading untuk tiap resep.";

        $response = Http::withOptions(['verify' => false])
            ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    ['parts' => [['text' => $prompt]]]
                ]
            ]);

        if ($response->failed()) {
            return back()->withErrors(['error' => 'Gagal menghubungi Gemini API: ' . $response->body()]);
        }

        $data = $response->json();
        $aiText = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$aiText) {
            return back()->withErrors(['error' => 'Respon Gemini kosong atau format tidak sesuai.']);
        }

        $recipe = Recipe::create([
            'user_id' => auth()->id(),
            'ingredients_input' => $ingredients,
            'title' => 'Resep dari: ' . $ingredients,
            'content' => $aiText,
        ]);

        return redirect()->route('recipes.show', $recipe->id);
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    // Daftar histori resep user
    public function index()
    {
        $recipes = Recipe::where('user_id', auth()->id())->latest()->get();
        return view('recipes.index', compact('recipes'));
    }

    // Toggle bookmark
    public function bookmark(Recipe $recipe)
    {
        $recipe->update(['is_bookmarked' => !$recipe->is_bookmarked]);
        return back();
    }
}