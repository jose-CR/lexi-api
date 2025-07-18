<x-app-layout>
    <x-guest-layout>
        <form action="{{ route('categories.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="category" class="block text-white">Category:</label>
            <input type="text" id="category" name="category" value="{{ $category->category ?? '' }}" placeholder="Category" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
            <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update</button>
        </form>
    </x-guest-layout>
</x-app-layout>