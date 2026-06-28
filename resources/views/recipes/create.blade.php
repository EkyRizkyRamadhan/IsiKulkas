<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Resep dari Bahan Seadanya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('recipes.generate') }}">
                    @csrf

                    <label class="block font-medium text-sm text-gray-700 mb-2">
                        Masukkan bahan-bahan yang kamu punya (pisahkan dengan koma)
                    </label>
                    <textarea name="ingredients" rows="4" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Contoh: telur, nasi sisa, bawang putih, kecap manis">{{ old('ingredients') }}</textarea>

                    <button type="submit"
                        class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">
                        🍳 Generate Resep
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>