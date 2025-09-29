<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInput extends Component
{
    public string $id;
    public string $name;
    public ?string $label;
    public array $options;
    public $selected;
    public ?string $placeholder;

    /**
     * Create a new component instance.
     */
    public function __construct(string $id, string $name, ?string $label = null, array $options = [],  $selected = null, ?string $placeholder = 'Select an option')
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->selected = $selected;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-input');
    }
}
