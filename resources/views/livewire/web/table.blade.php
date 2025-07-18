<div class="px-3 py-4 flex flex-col items-center">
    <table class="w-full border-collapse">
        <thead>
            <tr class="text-lg bg-blue-200">
                @foreach (array_keys($columns) as $label)
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
                                    <a href="{{ route($links['edit'], ['id' => $row->id]) }}"  class="bg-blue-500 text-white py-2 px-4 rounded">Editar</a>
                                    <form action="{{ route('categories.destroy', $row->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            @else
                                {{ $row->$field ?? '-' }}
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
</div>
