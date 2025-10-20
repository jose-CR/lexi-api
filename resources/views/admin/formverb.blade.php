<?php
use App\Models\Word;

$columns = [
    'Id' => 'id',
    'letter' => 'letter',
    'Word' => 'word',
    'Acciones' => 'actions',
    'Pasado' => 'times.pasado',
    'Ing' => 'times.ing',
];

$model = Word::class;

$searchColumns = ['id', 'word', 'letter'];

$links = [
    'edit' => 'word-edit',
    'delete' => 'word.destroy',
    'form-verb' => 'word-formverb',
];

?>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <livewire:web.table  :columns="$columns" :model="$model" :links="$links" :search-columns="$searchColumns"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>