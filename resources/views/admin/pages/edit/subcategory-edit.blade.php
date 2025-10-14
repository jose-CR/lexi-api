<x-app-layout>
    <x-guest-layout>
        <form id="subcategoryFormEdit" method="POST" action="{{ route('subcategory.edit', $subcategory->id) }}">
            @csrf
            @method('PATCH')

            <x-select-input 
            id="categoryId"
            name="categoryId"
            :label="__('Categories:')"
            :options="$categories"
            :selected="old('categoryId', $subcategory->category_id)"
            placeholder="Select a category"
            />

            <x-input-label for="subCategory" :value="_('Sub category:')"/>
            <x-text-input id="subCategory" name="subCategory" class="block mt-1 w-full" type="text" value="{{ old('subcategory', $subcategory->subcategory) }}" required autofocus autocomplete="name of edit Sub Category"/>

            <livewire:web.button.button :button="'edit'" :name="'edit subcategory'" :type-form="'subcategoryFormEdit'"/>
        </form> 
    </x-guest-layout>
</x-app-layout>