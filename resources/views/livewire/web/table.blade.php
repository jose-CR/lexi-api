<div class="px-3 py-4 flex flex-col items-center">
    <div class="mb-4 flex flex-col md:flex-row justify-between items-center w-full gap-4">
        {{-- Botón a la izquierda --}}
        <a href="{{ route($links['create']) }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
            {{ $button }}
        </a>

        {{-- Input de búsqueda a la derecha --}}
        <input 
            type="text" 
            class="border border-gray-300 rounded-lg p-2 w-full md:w-1/2 outline-none text-black"
            placeholder="Buscar"
            wire:model.live="search"
        >
    </div>
    <table class="w-full border-collapse">
        <thead>
            <tr class="text-lg bg-blue-200">
                @foreach ($columns as $label => $field)
                    <th class="py-3 font-bold text-center bg-gray-200 text-gray-600 border border-gray-300">
                        {{ $label }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr class="text-base bg-white">
                    @foreach ($columns as $label => $field)
                        <td class="border border-gray-300 py-2 px-4 text-center text-black">
                            @if ($label === 'Acciones')
                                <div class="flex items-center justify-center space-x-4">
                                    <a href="{{ route($links['edit'], ['id' => $row->id]) }}" class="bg-blue-500 text-white py-2 px-4 rounded">Editar</a>
                                    <form action="{{ route($links['delete'], $row->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Eliminar</button>
                                    </form>
                                </div>
                            @else
                                {{ data_get($row, $field, '-') }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}" class="text-center py-4 text-gray-600">
                        No hay datos disponibles.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4 flex justify-center w-full">
        <div class="pagination-container bg-white p-4 border border-gray-300 rounded-lg shadow-md">{{ $rows->links() }}</div>
    </div>
</div>
