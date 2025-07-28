<x-app-layout>
    <x-guest-layout>
        <form id="subcategoryFormEdit" method="POST" action="{{ route('subcategory.edit', $subcategory->id) }}">
            @csrf
            @method('PUT')
            <label for="subcategory" class="text-white">Sub Category:</label>
            <input type="text" name="subCategory" id="subcategory" class="w-full mt-5 mb-7 rounded-lg border border-blue-500 text-black shadow-lg outline-none" placeholder="Sub category" value="{{ old('subcategory', $subcategory->subcategory) }}">
            <livewire:web.button.button :button="'edit'" :name="'edit subcategory'" :type-form="'subcategoryFormEdit'"/>
        </form> 
    </x-guest-layout>
</x-app-layout>