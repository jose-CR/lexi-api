<?php 
use App\Models\Category;

$columns = [
    'Id' => 'id',
    'Nombre' => 'category',
    'Acciones' => 'actions',
];

$Category = Category::orderBy('id', 'asc')->get();

$links = [
    'edit' => 'category-edit',
];
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center text-xl mx-4">English category List</h1>
                    <a href="{{ route('category-create') }}" class="bg-green-500 text-white py-1 px-2 mx-2 my-4 rounded hover:bg-green-600">
                        Create Category
                    </a>
                    <livewire:web.table :columns="$columns" :rows="$Category" :links="$links" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>