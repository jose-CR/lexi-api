@props([
    'id',
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => 'Select an option',
    ])

<section class="mb-4">
    @if($label)
        <x-input-label for="{{ $id }}" :value="$label" />
    @endif

    <select
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'w-full py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-400'
        ]) }}
    >
        @if($placeholder)
            <option value="" disabled {{ $selected ? '' : 'selected' }}>
                {{ $placeholder }}
            </option>
        @endif

        @foreach($options as $value => $display)
            <option value="{{ $value }}" {{ (string)$value === (string)$selected ? 'selected' : '' }}>
                {{ $display }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</section>