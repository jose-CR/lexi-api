<?php
namespace App\Livewire\Web;

use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public array $searchColumns = [];
    public array $columns = [];
    public array $links = [];
    public string $model;
    public string $orderBy = 'id';
    public string $orderDir = 'asc';
    public $search = '';
    public string $button = "Crear";

    protected $updatesQueryString = ['search'];

    public function mount(array $columns = [], array $links = [], string $model, array $searchColumns = [], string $button): void
    {
        $this->columns = $columns;
        $this->links = $links;
        $this->model = $model;
        $this->searchColumns = $searchColumns ?: array_values($columns);
        $this->button = $button;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function getRows()
    {
        // Verificamos si la clase existe
        if (!class_exists($this->model)) {
            abort(500, "Model class {$this->model} does not exist.");
        }

        $query = $this->model::query();
        
        if($this->search && count($this->searchColumns) > 0){
            $query->where(function($q) {
                foreach ($this->searchColumns as $col){
                    $q->orWhere($col, 'like', '%' . $this->search . '%');
                }
            });
        }

        return $query->orderBy($this->orderBy, $this->orderDir)->paginate(10);
    }

    public function render()
    {
        $rows = $this->getRows();
    
        return view('livewire.web.table', [
            'columns' => $this->columns,
            'links' => $this->links,
            'rows' => $rows,
        ]);
    }
}
