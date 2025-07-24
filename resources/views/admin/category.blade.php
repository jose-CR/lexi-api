<?php 
use App\Models\Category;

$columns = [
    'Id' => 'id',
    'Categorias' => 'category',
    'Acciones' => 'actions',
];

$model = Category::class;

$searchColumns = ['id', 'category'];

$links = [
    'create' => 'category-create',
    'edit' => 'category-edit',
    'delete' => 'category.destroy'
];
?>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center text-xl mx-4">English category List</h1>
                    <livewire:web.table  :columns="$columns" :model="$model" :links="$links" :search-columns="$searchColumns" button="create category"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>