<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Histori Resep Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('recipes.create') }}"
                class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">
                + Buat Resep Baru
            </a>

            <div class="bg-white shadow-sm sm:rounded-lg divide-y">
                @forelse ($recipes as $recipe)
                    <a href="{{ route('recipes.show', $recipe->id) }}"
                        class="block p-4 hover:bg-gray-50 flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-800">{{ $recipe->title }}</p>
                            <p class="text-sm text-gray-500">{{ $recipe->created_at->diffForHumans() }}</p>
                        </div>
                        @if ($recipe->is_bookmarked)
                            <span class="text-yellow-500">★</span>
                        @endif
                    </a>
                @empty
                    <p class="p-4 text-gray-500 text-sm">Belum ada resep. Yuk buat yang pertama!</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>