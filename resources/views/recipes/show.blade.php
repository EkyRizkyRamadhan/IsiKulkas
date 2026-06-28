<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $recipe->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-4 flex justify-between items-center">
                    <span class="text-sm text-gray-500">Bahan: {{ $recipe->ingredients_input }}</span>

                    <form method="POST" action="{{ route('recipes.bookmark', $recipe->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="px-3 py-1 text-sm rounded-md {{ $recipe->is_bookmarked ? 'bg-yellow-400 text-white' : 'bg-gray-200 text-gray-700' }}">
                            {{ $recipe->is_bookmarked ? '★ Bookmarked' : '☆ Bookmark' }}
                        </button>
                    </form>
                </div>

                <div class="prose max-w-none whitespace-pre-line text-gray-800">
                    {{ $recipe->content }}
                </div>

                <a href="{{ route('recipes.index') }}" class="mt-6 inline-block text-indigo-600 hover:underline">
                    ← Kembali ke Histori Resep
                </a>
            </div>
        </div>
    </div>
</x-app-layout>