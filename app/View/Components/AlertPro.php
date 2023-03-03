<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertPro extends Component
{
    public $color;
    public $message;
    public $strongMessage;
    /**
     * Create a new component instance.
     */
    public function __construct($color, $message, $strongMessage)
    {
        $this->color = $color;
        $this->message = $message;
        $this->strongMessage = $strongMessage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-pro', [
            'color' => $this->color,
            'message' => $this->message,
            'strongMessage' => $this->strongMessage
        ]);
    }
}
