<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class checkbox extends Component
{
    public $name;
    public $label;
    public $isChecked;
    public $value;
    /**
     * Create a new component instance.
     */
    public function __construct( $name, $label, $value = "", $isChecked=false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->isChecked = $isChecked;
        $this->value = $value;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.checkbox', [
            'name' => $this->name,
            'label' => $this->label,
            'isChecked' => $this->isChecked,
            'value' => $this->value,
        ]);
    }
}
