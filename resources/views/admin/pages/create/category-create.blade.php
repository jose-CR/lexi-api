<x-app-layout>
    <x-guest-layout>
        <form action="{{route('categories.store')}}" method="post">
            @csrf
            <label for="category" class="block text-white">Category:</label>
            <input type="text" id="category" name="category" value="{{''}}" placeholder="Category" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
            <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Create</button>
        </form>
    </x-guest-layout>
</x-app-layout>