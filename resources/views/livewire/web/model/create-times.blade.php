<div class="md:col-span-2">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-200">Tiempos</h2>

    {{-- Bloques activos --}}
    @foreach($times as $type => $time)
        <div class="mb-6 p-4 border rounded-lg shadow-sm bg-gray-50 dark:bg-gray-800">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-white">{{ ucfirst($type) }}</h3>
                <button type="button" wire:click="removeTime('{{ $type }}')" class="px-3 py-1 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">Eliminar</button>
            </div>

            <div class="mb-3">
                <x-input-label :for="'times['.$type.'][definition]'" :value="'Definition:'"/>
                <x-text-input wire:model="times.{{ $type }}.definition" name="times[{{ $type }}][definition]" type="text" class="block mt-1 w-full" placeholder="Ej: illum, fugiat, praesentium"/>
            </div>

            <div class="mb-3">
                <x-input-label :for="'times['.$type.'][sentence]'" :value="'Oración en inglés:'"/>
                <x-text-input wire:model="times.{{ $type }}.sentence" name="times[{{ $type }}][sentence]" type="text" class="block mt-1 w-full" placeholder="Ej: Learning is shaping the world..."/>
            </div>

            <div class="mb-3">
                <x-input-label :for="'times['.$type.'][spanishSentence]'" :value="'Oración en español:'"/>
                <x-text-input wire:model="times.{{ $type }}.spanishSentence" name="times[{{ $type }}][spanishSentence]" type="text" class="block mt-1 w-full" placeholder="Ej: Estamos construyendo nuevos caminos..."/>
            </div>
        </div>
    @endforeach

    {{-- Selector de nuevo bloque --}}
    <div class="flex gap-2 items-center mt-4">
        <select wire:model="selectedType" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200">
            <option value="">Selecciona un tipo de tiempo</option>
            @foreach($availableTypes as $type)
                @if(!isset($times[$type]))
                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                @endif
            @endforeach
        </select>

        <button type="button" wire:click="addTime" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
            + Agregar tiempo
        </button>
    </div>
</div>