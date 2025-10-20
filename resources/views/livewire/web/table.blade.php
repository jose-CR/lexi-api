<div class="px-3 py-4 flex flex-col items-center">
    @if ($button)
        {{-- Layout con botón y buscador --}}
        <section class="mb-4 flex flex-col md:flex-row justify-between items-center w-full gap-4">
            <a href="{{ route($links['create']) }}" 
               class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
                {{ $button }}
            </a>
            <input 
                type="text" 
                class="border border-gray-300 rounded-lg p-2 w-full md:w-1/2 outline-none text-black"
                placeholder="Buscar"
                wire:model.live="search"
            >
        </section>
    @else
        {{-- Layout solo con buscador centrado --}}
        <section class="mb-4 flex justify-center w-full">
            <input 
                type="text" 
                class="border border-gray-300 rounded-lg p-2 w-full md:w-1/2 outline-none text-black"
                placeholder="Buscar"
                wire:model.live="search"
            >
        </section>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="text-lg bg-blue-200">
                @foreach ($columns as $label => $field)
                    @if ($label !== 'Acciones')
                        <th class="py-3 font-bold text-center bg-gray-200 text-gray-600 border border-gray-300">
                            {{ $label }}
                        </th>
                    @endif
                @endforeach
                <th class="py-3 font-bold text-center bg-gray-200 text-gray-600 border border-gray-300">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr class="text-base bg-white">
                    @foreach ($columns as $label => $field)
                        @if ($label !== 'Acciones')
                            <td class="border border-gray-300 py-2 px-4 text-center text-black">
                                @if (\Illuminate\Support\Str::startsWith($field, 'times.'))
                                    @if ($row->columnData[$field])
                                        <div class="text-left">
                                            <span class="italic">{{ $row->columnData[$field]['sentence'] }}</span><br>
                                            <span class="text-gray-500">{{ $row->columnData[$field]['spanishSentence'] }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">No hay datos</span>
                                    @endif
                                @else
                                    {{ $row->columnData[$field] }}
                                @endif
                            </td>
                        @endif
                    @endforeach
                    
                    <td class="border border-gray-300 py-2 px-4 text-center text-black">
                        <div class="flex items-center justify-center space-x-4">
                            <a href="{{ route($links['edit'], ['id' => $row->id]) }}" 
                               class="bg-blue-500 text-white py-2 px-4 rounded">
                                Editar
                            </a>

                            @if(isset($links['form-verb']))
                                <a href="{{ route($links['form-verb'], ['id' => $row->id]) }}" 
                                   class="bg-blue-500 text-white py-2 px-4 rounded">
                                    Forma verbal
                                </a>
                            @endif

                            <form action="{{ route($links['delete'], $row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}" class="text-center py-4 text-white">
                        No hay datos disponibles.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4 flex justify-center w-full">
        <div class="pagination-container bg-white p-4 border border-gray-300 rounded-lg shadow-md">
            {{ $rows->links() }}
        </div>
    </div>
</div>