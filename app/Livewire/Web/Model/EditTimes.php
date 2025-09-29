<?php

namespace App\Livewire\Web\Model;

use Livewire\Component;

class EditTimes extends Component
{
    public array $times = [];
    public array $availableTypes = ['pasado', 'ing', 'futuro'];
    public string $selectedType = '';

    // Recibir los tiempos existentes desde el controlador
    public function mount(array $times = [])
    {
        $this->times = $times;
    }

    public function addTime()
    {
        if ($this->selectedType && !isset($this->times[$this->selectedType])) {
            $this->times[$this->selectedType] = [
                'definition' => '',
                'sentence' => '',
                'spanishSentence' => '',
            ];
            $this->selectedType = '';
        }
    }

    public function removeTime($type)
    {
        unset($this->times[$type]);
    }

    public function render()
    {
        return view('livewire.web.model.edit-times');
    }
}
