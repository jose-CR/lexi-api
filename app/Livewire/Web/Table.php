<?php

namespace App\Livewire\Web;

use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{

    use WithPagination;

    public array $columns = [];
    public iterable $rows = [];
    public array $links = [];
    public ?string $deleteHandler = null;

    public function mount(array $columns = [], iterable $rows = [], array $links = [], ?string $deleteHandler = null): void
    {
        $this->columns = $columns;
        $this->rows = $rows;
        $this->links = $links;
        $this->deleteHandler = $deleteHandler;
    }

    public function render()
    {
        return view('livewire.web.table');
    }
}
