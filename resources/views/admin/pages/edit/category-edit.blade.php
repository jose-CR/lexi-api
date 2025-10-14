<x-app-layout>
    <x-guest-layout>
        <form id="categoryFormEdit" action="{{ route('category.edit', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <x-input-label for="category" :value="_('Category:')"/>
            <x-text-input 
                id="category" 
                name="category" 
                class="block mt-1 w-full" 
                type="text" 
                :value="$category->category ?? ''" 
                required 
                autofocus 
                autocomplete="off"
            />
            <livewire:web.button.button :button="'edit'" :name="'edit category'" :type-form="'categoryFormEdit'"/>
        </form>
    </x-guest-layout>
</x-app-layout>