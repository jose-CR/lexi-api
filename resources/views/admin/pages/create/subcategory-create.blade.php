<x-app-layout>
    <x-guest-layout>
        <form id="subcategoryForm" action="{{ route('subcategory.store') }}" method="post">
            @csrf
            <h1 class="text-2xl text-white text-center mb-4">create sub category</h1>

            <section class="mb-4">
                <label for="categoryId" class="block mb-2 text-white">Categories</label>
                <select name="categoryId" id="categoryId" class="w-full py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-400">
                    <option value="" disabled selected>Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </section>

            <section class="mb-4">
                <label for="subCategory" class="block mb-2 text-white">Sub category</label>
                <input type="text" name="subCategory" id="subCategory" class="w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-400">
            </section>

            <livewire:web.button.button :button="'create'" :name="'Create sub category'" :type-form="'subcategoryForm'" />
        </form> 
    </x-guest-layout>
</x-app-layout>
