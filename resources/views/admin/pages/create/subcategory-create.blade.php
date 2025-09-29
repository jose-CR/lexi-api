<x-app-layout>
    <x-guest-layout>
        <form id="subcategoryForm" action="{{ route('subcategory.store') }}" method="post">
            @csrf
            <h1 class="text-2xl text-white text-center mb-4">create sub category</h1>

            <x-select-input 
            id="categoryId"
            name="categoryId"
            :label="__('Categories')"
            :options="$categories"
            :selected="old('categoryId')"
            placeholder="Select a category"
            />

            <section class="mb-4">
                <x-input-label for="subCategory" :value="_('Sub category:')"/>
                <x-text-input id="subCategory" name="subCategory" class="block mt-1 w-full" type="text" required autofocus autocomplete="name of Sub Category"/>
            </section>

            <livewire:web.button.button :button="'create'" :name="'Create sub category'" :type-form="'subcategoryForm'" />
        </form> 
    </x-guest-layout>
</x-app-layout>
