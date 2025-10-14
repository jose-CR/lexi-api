<div class="md:col-span-2">
    <h2 class="text-lg font-medium mb-4 text-gray-700 dark:text-gray-300">Tiempos Verbales</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($times as $index => $time)
            @php
                $timeKey = $time['key'] ?? $index;
            @endphp
            <div class="border p-4 rounded-md bg-gray-50 dark:bg-gray-800">
                {{-- Selector de tiempo verbal --}}
                <div class="flex justify-between items-center mb-2">
                    <select wire:model="times.{{ $index }}.title"
                            class="w-3/4 border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 
                                   bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Selecciona un tiempo verbal --</option>
                        <option value="Pasado">Pasado</option>
                        <option value="Presente">Presente</option>
                        <option value="Presente progresivo">Presente progresivo</option>
                        <option value="Futuro">Futuro</option>
                        <option value="Condicional">Condicional</option>
                    </select>

                    <button type="button"
                            wire:click="removeTime({{ $index }})"
                            class="text-red-500 hover:text-red-700 text-sm ml-2">
                        Eliminar
                    </button>
                </div>

                {{-- Definición --}}
                <x-input-label for="definition_{{ $timeKey }}" :value="_('Definición:')"/>
                <x-text-input id="definition_{{ $timeKey }}"
                              name="times[{{ $timeKey }}][definition]"
                              type="text"
                              class="block mt-1 w-full"
                              placeholder="Ej: Big cat, Predator, Jungle"
                              :value="$time['definition'] ?? ''"/>

                {{-- Oración en inglés --}}
                <x-input-label for="sentence_{{ $timeKey }}" :value="_('Oración en inglés:')"/>
                <x-text-input id="sentence_{{ $timeKey }}"
                              name="times[{{ $timeKey }}][sentence]"
                              type="text"
                              class="block mt-1 w-full"
                              placeholder="Ej: the tiger hunts in the jungle"
                              :value="$time['sentence'] ?? ''"/>

                {{-- Oración en español --}}
                <x-input-label for="spanishSentence_{{ $timeKey }}" :value="_('Oración en español:')"/>
                <x-text-input id="spanishSentence_{{ $timeKey }}"
                              name="times[{{ $timeKey }}][spanishSentence]"
                              type="text"
                              class="block mt-1 w-full"
                              placeholder="Ej: el tigre caza en la jungla"
                              :value="$time['spanishSentence'] ?? ''"/>
            </div>
        @endforeach    
    </div>

    {{-- Botón para agregar más tiempos --}}
    <div class="mt-4">
        <button type="button"
                wire:click="addTime"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            + Añadir tiempo verbal
        </button>
    </div>
</div>