<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-6 bg-white dark:bg-gray-900 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center mb-8 text-gray-800 dark:text-gray-100">Crear Palabra</h1>

        <form id="wordForm" action="{{ route('word.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            {{-- Subcategoría --}}
            <div>
                <label for="subCategoryId" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Subcategoría</label>
                <select name="subCategoryId" required class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Selecciona una subcategoría</option>
                    @foreach($subCategories as $subcategory)
                        <option value="{{ $subcategory->id }}">
                            {{ $subcategory->category->category }} || {{ $subcategory->subcategory }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Letra --}}
            <div>
                <label for="letter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Letra</label>
                <select name="letter" required class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Selecciona una letra</option>
                    @foreach ($uniqueLetters as $letter)
                        <option value="{{ $letter }}">{{ $letter }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Palabra --}}
            <div>
                <label for="word" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Palabra</label>
                <input type="text" name="word" required placeholder="Ej: Tiger" class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Definición --}}
            <div>
                <label for="definition" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Definición <small class="text-xs text-gray-400">(separa con comas)</small></label>
                <input type="text" name="definition" required placeholder="Ej: Big cat, Predator, Jungle" class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Oración en inglés --}}
            <div>
                <label for="sentence" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Oración en inglés</label>
                <input type="text" name="sentence" placeholder="Ej: The tiger hunts in the jungle." class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Oración en español --}}
            <div>
                <label for="spanishSentence" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Oración en español</label>
                <input type="text" name="spanishSentence" placeholder="Ej: El tigre caza en la jungla." class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Times (Pasado e ING) --}}
            <div class="md:col-span-2">
                <h2 class="text-lg font-medium mb-4 text-gray-700 dark:text-gray-300">Tiempos Verbales</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Pasado --}}
                    <div class="border p-4 rounded-md bg-gray-50 dark:bg-gray-800">
                        <h3 class="font-semibold mb-2 text-white">Pasado</h3>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Definición <small class="text-xs text-gray-400">(coma separadas)</small></label>
                        <input type="text" name="times[pasado][definition]" placeholder="Ej: ullum, vitae" class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 mb-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Oración en inglés</label>
                        <input type="text" name="times[pasado][sentence]" placeholder="Ej: Yesterday we..." class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 mb-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Oración en español</label>
                        <input type="text" name="times[pasado][spanishSentence]" placeholder="Ej: Ayer nosotros..." class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- ING --}}
                    <div class="border p-4 rounded-md bg-gray-50 dark:bg-gray-800">
                        <h3 class="font-semibold mb-2 text-white">Presente progresivo</h3>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Definición <small class="text-xs text-gray-400">(coma separadas)</small></label>
                        <input type="text" name="times[ing][definition]" placeholder="Ej: illum, fugiat" class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 mb-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Oración en inglés</label>
                        <input type="text" name="times[ing][sentence]" placeholder="Ej: We are learning..." class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 mb-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Oración en español</label>
                        <input type="text" name="times[ing][spanishSentence]" placeholder="Ej: Estamos aprendiendo..." class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            {{-- Botón --}}
            <div class="md:col-span-2 pt-4">
                <livewire:web.button.button :button="'create'" :name="'Create word'" :type-form="'wordForm'"/>
            </div>
        </form>
    </div>
</x-app-layout>
