<?php
namespace App\Livewire\Web;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

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
    public ?string $button = null;

    protected $updatesQueryString = ['search'];

    public function mount(array $columns = [], array $links = [], string $model, array $searchColumns = [], ?string $button = null): void
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
        if (!class_exists($this->model)) {
            abort(500, "Model class {$this->model} does not exist.");
        }
    
        $query = $this->model::query();
    
        if ($this->search && count($this->searchColumns) > 0) {
            $query->where(function ($q) {
                foreach ($this->searchColumns as $col) {
                    $q->orWhere($col, 'like', '%' . $this->search . '%');
                }
            });
        }
    
        $rows = $query->orderBy($this->orderBy, $this->orderDir)->paginate(10);
    
        $rows->getCollection()->transform(function ($row) {
            $rowArray = $row->toArray();
            $rowArray['timesParsed'] = [];
    
            if (!empty($rowArray['times']) && is_array($rowArray['times'])) {
                foreach ($rowArray['times'] as $key => $data) {
                    if (is_array($data) && isset($data[0])) {
                        $rowArray['timesParsed'][$key] = [
                            'sentence' => $data[0]['sentence'] ?? null,
                            'spanishSentence' => $data[0]['spanishSentence'] ?? null,
                        ];
                    } elseif (is_array($data)) {
                        $rowArray['timesParsed'][$key] = [
                            'sentence' => $data['sentence'] ?? null,
                            'spanishSentence' => $data['spanishSentence'] ?? null,
                        ];
                    } else {
                        $rowArray['timesParsed'][$key] = null;
                    }
                }
            }
    
            // Precalcular columnas de times para cada columna
            $rowArray['columnData'] = [];
            foreach ($this->columns as $label => $field) {
                if (\Illuminate\Support\Str::startsWith($field, 'times.')) {
                    $timeKey = \Illuminate\Support\Str::after($field, 'times.');
                    $rowArray['columnData'][$field] = $rowArray['timesParsed'][$timeKey] ?? null;
                } else {
                    $rowArray['columnData'][$field] = $rowArray[$field] ?? 'no hay datos almacenados';
                }
            }
    
            return (object) $rowArray;
        });
    
        return $rows;
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