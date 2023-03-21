<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $name;
    public $label;
    public $defaultValue;
    public $isRequired;
    public $isReadonly;

    /**
     * Create a new component instance.
     */
    public function __construct($type, $name, $label, $defaultValue = "BOXZ123__223", $isRequired = false, $isReadonly = false)
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->defaultValue = $defaultValue;
        $this->isRequired = $isRequired;
        $this->isReadonly = $isReadonly;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input', [
            'type' => $this->type,
            'name' => $this->name,
            'label' => $this->label,
            'value' => $this->defaultValue,
            'isRequired' => $this->isRequired,
            'isReadonly' => $this->isReadonly,
        ]);
    }
}
