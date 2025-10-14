<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-6 bg-white dark:bg-gray-900 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center mb-8 text-gray-800 dark:text-gray-100">Crear Palabra</h1>

        <form id="wordForm" action="{{ route('word.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            {{-- Subcategoría --}}
            <div>
                <x-select-input
                id="subCategoryId"
                name="subCategoryId"
                :label="_('Sub Categories:')"
                :options="$subCategories"
                :selected="old('subCategoryId')"
                placeholder="select a sub category"
                />
            </div>

            {{-- Letra --}}
            <div>
                <x-select-input 
                id="letter"
                name="letter"
                :label="_('Letter:')"
                :options="$uniqueLetters"
                :selected="old('letter')"
                placeholder="select a letter"
                />
            </div>

            {{-- Palabra --}}
            <div>
                <x-input-label for="word" :value="_('Palabra:')"/>
                <x-text-input id="word" name="word" type="text" class="block mt-1 w-full" required autofocus autocomplete="name of the Word" placeholder="run"/>
            </div>

            {{-- Definición --}}
            <div>
                <x-input-label for="definition" :value="_('Definition:')"/>
                <x-text-input id="definition" name="definition" type="text" class="block mt-1 w-full" required autofocus autocomplete="name of the Word" placeholder="Ej: Big cat, Predator, Jungle"/>
            </div>

            {{-- Oración en inglés --}}
            <div>
                <x-input-label for="sentence" :value="_('Oración in inglish:')"/>
                <x-text-input id="sentence" name="sentence" type="text" class="block mt-1 w-full" required autofocus autocomplete="name of the Word" placeholder="Ej: the tiger hunts in the jungle"/>
            </div>

            {{-- Oración en español --}}
            <div>
                <x-input-label for="spanishSentence" :value="_('Oracion in spanish:')"/>
                <x-text-input id="spanishSentence" name="spanishSentence" type="text" class="block mt-1 w-full" required autofocus autocomplete="name of the Word" placeholder="Ej: el tigre caza en la jungla"/>
            </div>

            {{-- Times --}}
            <livewire:web.model.create-times  />

            {{-- Botón --}}
            <div class="md:col-span-2 pt-4">
                <livewire:web.button.button :button="'create'" :name="'Create word'" :type-form="'wordForm'"/>
            </div>
        </form>
    </div>
</x-app-layout>
