<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DatatableHead extends Component
{
    public $title;
    public $description;
    /**
     * Create a new component instance.
     */
    public function __construct($title = "", $description = "")
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.datatable-head', [
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
