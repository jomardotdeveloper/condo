<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $label;
    public $name;
    public $options;
    public $defaultValue;
    public $isRequired;
    public $onchange;
    /**
     * Create a new component instance.
     */
    public function __construct($label, $name, $options = [], $defaultValue = "", $isRequired = false, $onchange = "")
    {
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
        $this->defaultValue = $defaultValue;
        $this->isRequired = $isRequired;
        $this->onchange = $onchange;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select', [
            'label' => $this->label,
            'name' => $this->name,
            'options' => $this->options,
            'value' => $this->defaultValue,
            'isRequired' => $this->isRequired,
            'onchange' => $this->onchange,
        ]);
    }
}
