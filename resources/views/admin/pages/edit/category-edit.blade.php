<x-app-layout>
    <x-guest-layout>
        <form id="categoryFormEdit" action="{{ route('category.edit', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="category" class="block text-white">Category:</label>
            <input type="text" id="category" name="category" value="{{ $category->category ?? '' }}" placeholder="Category" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
            <livewire:web.button.button :button="'edit'" :name="'edit category'" :type-form="'categoryFormEdit'"/>
        </form>
    </x-guest-layout>
</x-app-layout>