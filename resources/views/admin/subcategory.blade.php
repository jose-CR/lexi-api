<?php
use App\Models\SubCategory;

$columns = [
    'Id' => 'id',
    'Sub categorias' => 'subcategory',
    'Acciones' => 'actions',
];

$model = SubCategory::class;

$searchColumns = ['id', 'subcategory'];

$links = [
    'create' => 'subcategory-create',
    'edit' => 'subcategory-edit',
    'delete' => 'subcategory.destroy'
];

?>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <livewire:web.table  :columns="$columns" :model="$model" :links="$links" :search-columns="$searchColumns" button="create subcategory"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>