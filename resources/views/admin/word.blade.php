<?php
use App\Models\Word;

$columns = [
    'Id' => 'id',
    'letter' => 'letter',
    'Word' => 'word',
    'definition' => 'string_definition',
    'oracion' => 'sentence',
    'oracion en español' => 'spanish_sentence',
    'Acciones' => 'actions',
];

$model = Word::class;

$searchColumns = ['id', 'word'];

$links = [
    'create' => 'word-create',
    'edit' => 'word-edit',
    'delete' => 'word.destroy'
];

?>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <livewire:web.table  :columns="$columns" :model="$model" :links="$links" :search-columns="$searchColumns" button="create word"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>