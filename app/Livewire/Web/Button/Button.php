<?php

namespace App\Livewire\Web\Button;

use Exception;
use Livewire\Component;

class Button extends Component
{

    public string $button = '';
    public string $name = '';
    public string $typeForm = '';
    public string $errorMessage = '';

    public function mount($button = '', $name = '', $typeForm = ''){
        $this->button = $button;
        $this->name = $name;
        $this->typeForm = $typeForm;
        $this->validateProps();
    }

    private function validateProps(){
        if (empty($this->button)) {
            throw new Exception("⚠️ El parámetro 'button' es obligatorio en el componente Button.");
        }

        if (empty($this->typeForm)) {
            throw new Exception("⚠️ El parámetro 'typeForm' (ID del formulario) es obligatorio en el componente Button.");
        }
    }

    public function showNotification(){
        $this->validateProps();

        if ($this->errorMessage) return;
        
        $button = $this->button;

        if($button == 'create'){
            $this->dispatch(
                'alert',
                type: 'success',
                title: $button,
                position: 'center',
                timer: 1500,
                form: $this->typeForm,
            );
        }

        elseif($button == 'edit'){
            $this->dispatch(
                'alert',
                type: 'success',
                title: $button,
                position: 'center',
                timer: 1500,
                form: $this->typeForm,
            );
        }

        elseif($button == 'delete'){
            $this->dispatch(
                'alert',
                type: 'success',
                title: $button,
                position: 'center',
                timer: 1500,
                form: $this->typeForm,
            );
        }
    }

    public function render()
    {
        return view('livewire.web.button.button');
    }
}
