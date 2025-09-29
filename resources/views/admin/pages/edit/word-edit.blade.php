@php
    $wordTimes = is_string($word->times) ? json_decode($word->times, true) : ($word->times ?? []);
@endphp
<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6 bg-white dark:bg-gray-900 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center mb-8 text-gray-800 dark:text-gray-100">
            Edit Word
        </h1>

        <form id="wordFormEdit" 
              action="{{ route('word.edit', $word->id) }}" 
              method="POST" 
              class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PATCH')

            {{-- Sub Category --}}
            <div>
                <x-select-input
                id="subCategoryId"
                name="subCategoryId"
                :label="_('Sub Categories:')"
                :options="$subCategories"
                :selected="old('subCategoryId', $word->sub_category_id)"
                placeholder="select a sub category"
                />
            </div>

            {{-- Letter --}}
            <div>
                <div>
                    <x-select-input 
                    id="letter"
                    name="letter"
                    :label="_('Letter:')"
                    :options="$uniqueLetters"
                    :selected="old('letter', $word->letter)"
                    placeholder="select a letter"
                    />
                </div>
            </div>

            {{-- Word --}}
            <div>
                <x-input-label for="word" :value="_('Palabra:')"/>
                <x-text-input id="word" name="word" type="text" value="{{ old('word', $word->word) }}" class="block mt-1 w-full" required autofocus autocomplete="name of the Word" placeholder="run"/>
            </div>

            {{-- Definition --}}
            <div>
                <x-input-label for="definition" :value="_('Definition:')"/>
                <x-text-input id="definition" name="definition" type="text" value="{{ old('definition', $word->string_definition) }}" class="block mt-1 w-full" required autofocus autocomplete="name of the Word" placeholder="Ej: Big cat, Predator, Jungle"/>
            </div>

            {{-- English sentence --}}
            <div>
                <x-input-label for="sentence" :value="_('Oración in inglish:')"/>
                <x-text-input id="sentence" name="sentence" type="text" value="{{ old('sentence', $word->sentence) }}" class="block mt-1 w-full" required autofocus autocomplete="name of the Word" placeholder="Ej: the tiger hunts in the jungle"/>
            </div>

            {{-- Spanish sentence --}}
            <div>
                <x-input-label for="spanishSentence" :value="_('Oracion in spanish:')"/>
                <x-text-input id="spanish_sentence" name="spanish_sentence" type="text" value="{{ old('spanish_sentence', $word->spanish_sentence) }}" class="block mt-1 w-full" required autofocus autocomplete="name of the Word" placeholder="Ej: el tigre caza en la jungla"/>
            </div>

            {{--- times--}}

            <livewire:web.model.edit-times :times="$times"/>

            {{-- Submit --}}
            <div class="md:col-span-2 pt-4">
                <livewire:web.button.button 
                    :button="'edit'" 
                    :name="'Edit word'" 
                    :type-form="'wordFormEdit'"
                />
            </div>
        </form>
    </div>
</x-app-layout>