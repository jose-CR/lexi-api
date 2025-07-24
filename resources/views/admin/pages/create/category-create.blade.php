<x-app-layout>
    <x-guest-layout>
        <form id="categoryForm" action="{{ route('category.store') }}" method="POST">
            @csrf
            <label for="category" class="block text-white">Category:</label>
            <input type="text" id="category" name="category" value="{{''}}" placeholder="Category" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
            <livewire:web.button.button :button="'create'" :name="'Create category'" :type-form="'categoryForm'"/>
        </form>
    </x-guest-layout>
</x-app-layout>