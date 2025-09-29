<x-app-layout>
    <x-guest-layout>
        <form id="categoryForm" action="{{ route('category.store') }}" method="POST">
            @csrf
            <x-input-label for="category" :value="__('Category:')" />
            <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" value="{{''}}" required autofocus autocomplete="name of Category" />
            <livewire:web.button.button :button="'create'" :name="'Create category'" :type-form="'categoryForm'"/>
        </form>
    </x-guest-layout>
</x-app-layout>