<x-app-layout>
    <x-guest-layout>
        <form id="wordFormEdit" action="{{ route('word.edit', $word->id) }}" method="post">
            @csrf
            @method('PATCH')
            
            <label for="letter" class="block text-white">Letra:</label>
            <select name="letter" required class="w-full border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="" disabled>Selecciona una letra</option>
                @foreach ($uniqueLetters as $letter)
                    <option value="{{ $letter }}" {{ $letter === $word->letter ? 'selected' : '' }}>{{ $letter }}</option>
                @endforeach
            </select>
            
            <!-- Luego tus otros campos ya en snake_case -->
            <label for="word" class="block text-white">Palabra:</label>
            <input type="text" id="word" name="word" value="{{ $word->word ?? '' }}" placeholder="Palabra" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
            
            <label for="definition" class="block text-white">Definición:</label>
            <input type="text" id="definition" name="definition" value="{{ $word->string_definition ?? '' }}" placeholder="Definición, separa con comas" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
            
            <label for="sentence" class="block text-white">Oración en inglés:</label>
            <input type="text" id="sentence" name="sentence" value="{{ $word->sentence ?? '' }}" placeholder="Oración en inglés" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
            
            <label for="spanish_sentence" class="block text-white">Oración en español:</label>
            <input type="text" id="spanish_sentence" name="spanish_sentence" value="{{ $word->spanish_sentence ?? '' }}" placeholder="Oración en español" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">                    

            <livewire:web.button.button :button="'edit'" :name="'edit word'" :type-form="'wordFormEdit'"/>
        </form>
    </x-guest-layout>
</x-app-layout>