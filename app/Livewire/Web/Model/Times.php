<?php

namespace App\Http\Livewire\Web\Model;

use Livewire\Component;

class Times extends Component
{
    public array $times = [];

    // $word opcional para edición
    public $word;

    public function mount($word = null)
    {
        $this->word = $word;

        // 1️⃣ Si venimos de old input (errores)
        if (old('times')) {
            $this->times = old('times');
        }
        // 2️⃣ Si es edición → cargar del modelo
        elseif ($word) {
            $this->times = is_string($word->times)
                ? json_decode($word->times, true)
                : ($word->times ?? []);
        }
        // 3️⃣ Creación → base mínima
        else {
            $this->times = [
                ['key' => 'pasado', 'title' => 'Pasado', 'definition' => '', 'sentence' => '', 'spanishSentence' => ''],
                ['key' => 'ing', 'title' => 'Presente progresivo', 'definition' => '', 'sentence' => '', 'spanishSentence' => ''],
            ];
        }

        // Asegurar que cada tiempo tenga todas las claves
        foreach ($this->times as $i => $time) {
            $this->times[$i]['key'] = $time['key'] ?? $i;
            $this->times[$i]['title'] = $time['title'] ?? '';
            $this->times[$i]['definition'] = $time['definition'] ?? '';
            $this->times[$i]['sentence'] = $time['sentence'] ?? '';
            $this->times[$i]['spanishSentence'] = $time['spanishSentence'] ?? '';
        }
    }

    public function addTime()
    {
        $this->times[] = [
            'key' => 'nuevo_' . count($this->times),
            'title' => '',
            'definition' => '',
            'sentence' => '',
            'spanishSentence' => '',
        ];
    }

    public function removeTime($index)
    {
        unset($this->times[$index]);
        $this->times = array_values($this->times); // reindexar
    }

    public function render()
    {
        return view('livewire.web.model.times');
    }
}