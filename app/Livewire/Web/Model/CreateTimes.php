<?php

namespace App\Livewire\Web\Model;

use Livewire\Component;

class CreateTimes extends Component
{
    public array $times = [];
    public array $availableTypes = ['pasado', 'ing', 'futuro'];
    public string $selectedType = '';

    public function addTime()
    {
        if ($this->selectedType && !isset($this->times[$this->selectedType])) {
            $this->times[$this->selectedType] = [
                'definition' => null,
                'sentence' => null,
                'spanishSentence' => null,
            ];
            $this->selectedType = ''; // resetear selector
        }
    }

    public function removeTime($type)
    {
        unset($this->times[$type]);
    }

    public function render()
    {
        return view('livewire.web.model.create-times');
    }
}
