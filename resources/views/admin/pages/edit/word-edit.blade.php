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

            {{-- Letter --}}
            <div>
                <label for="letter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Letter
                </label>
                <select name="letter" id="letter" required
                        class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 
                               bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none 
                               focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled>Select a letter</option>
                    @foreach ($uniqueLetters as $letter)
                        <option value="{{ $letter }}" {{ $letter === $word->letter ? 'selected' : '' }}>
                            {{ strtoupper($letter) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Word --}}
            <div>
                <label for="word" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Word
                </label>
                <input type="text" id="word" name="word" value="{{ old('word', $word->word) }}"
                       placeholder="Ej: Tiger"
                       class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 
                              bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none 
                              focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Definition --}}
            <div class="md:col-span-2">
                <label for="definition" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Definition <small class="text-xs text-gray-400">(separate with commas)</small>
                </label>
                <input type="text" id="definition" name="definition"
                       value="{{ old('definition', $word->string_definition) }}"
                       placeholder="Ej: Big cat, Predator, Jungle"
                       class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 
                              bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none 
                              focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- English sentence --}}
            <div>
                <label for="sentence" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    English sentence
                </label>
                <input type="text" id="sentence" name="sentence"
                       value="{{ old('sentence', $word->sentence) }}"
                       placeholder="Ej: The tiger hunts in the jungle."
                       class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 
                              bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none 
                              focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Spanish sentence --}}
            <div>
                <label for="spanish_sentence" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Spanish sentence
                </label>
                <input type="text" id="spanish_sentence" name="spanish_sentence"
                       value="{{ old('spanish_sentence', $word->spanish_sentence) }}"
                       placeholder="Ej: El tigre caza en la jungla."
                       class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 
                              bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none 
                              focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- TIMES --}}
            <div class="md:col-span-2">
                <h2 class="text-lg font-medium mb-4 text-gray-700 dark:text-gray-300">
                    Tiempos Verbales
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Pasado --}}
                    <div class="border p-4 rounded-md bg-gray-50 dark:bg-gray-800">
                        <h3 class="font-semibold mb-2">Pasado</h3>

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Definición <small class="text-xs text-gray-400">(coma separadas)</small>
                        </label>
                        <input type="text" name="times[pasado][definition]"
                               value="{{ old('times.pasado.definition', $pasado['definition']) }}"
                               placeholder="Ej: ullam, vitae"
                               class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 mb-2 
                                      bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none 
                                      focus:ring-2 focus:ring-blue-500">

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Oración en inglés
                        </label>
                        <input type="text" name="times[pasado][sentence]"
                               value="{{ old('times.pasado.sentence', $pasado['sentence']) }}"
                               placeholder="Ej: Yesterday we..."
                               class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 mb-2 
                                      bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none 
                                      focus:ring-2 focus:ring-blue-500">

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Oración en español
                        </label>
                        <input type="text" name="times[pasado][spanishSentence]"
                               value="{{ old('times.pasado.spanishSentence', $pasado['spanishSentence']) }}"
                               placeholder="Ej: Ayer nosotros..."
                               class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 
                                      bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none 
                                      focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- ING --}}
                    <div class="border p-4 rounded-md bg-gray-50 dark:bg-gray-800">
                        <h3 class="font-semibold mb-2">ING</h3>

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Definición <small class="text-xs text-gray-400">(coma separadas)</small>
                        </label>
                        <input type="text" name="times[ing][definition]"
                               value="{{ old('times.ing.definition', $ing['definition']) }}"
                               placeholder="Ej: illum, fugiat"
                               class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 mb-2 
                                      bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none 
                                      focus:ring-2 focus:ring-blue-500">

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Oración en inglés
                        </label>
                        <input type="text" name="times[ing][sentence]"
                               value="{{ old('times.ing.sentence', $ing['sentence']) }}"
                               placeholder="Ej: We are learning..."
                               class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 mb-2 
                                      bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none 
                                      focus:ring-2 focus:ring-blue-500">

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Oración en español
                        </label>
                        <input type="text" name="times[ing][spanishSentence]"
                               value="{{ old('times.ing.spanishSentence', $ing['spanishSentence']) }}"
                               placeholder="Ej: Estamos aprendiendo..."
                               class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 
                                      bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none 
                                      focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

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