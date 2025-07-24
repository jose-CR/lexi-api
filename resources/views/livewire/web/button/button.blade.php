@php
    $classes = match($button) {
        'create' => 'mt-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700',
        'edit'   => 'mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-yellow-600',
        'delete' => 'mt-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700',
        default  => 'mt-4 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600',
    };

    $icons = match($button) {
        'create' => '➕',
        'edit'   => '✏️',
        'delete' => '🗑️',
        default  => '⚙️',
    };
@endphp

@if ($errorMessage)
    <div class="bg-red-600 text-white font-bold px-4 py-2 rounded mb-4">
        {{ $errorMessage }}
    </div>
@endif

<button
    type="button"
    @if ($button === 'delete')
        wire:click="confirmDelete"
    @else
        wire:click="showNotification"
    @endif
    class="{{ $classes }}"
>
    <span class="mr-1">{{ $icons }}</span> {{ $name }}
</button>