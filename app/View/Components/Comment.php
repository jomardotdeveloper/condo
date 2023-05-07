<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Comment extends Component
{
    public $comments;
    public $model;
    public $record;
    /**
     * Create a new component instance.
     */
    public function __construct($comments, $model, $record)
    {
        $this->comments = $comments;
        $this->model = $model;
        $this->record = $record;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comment', [
            'comments' => $this->comments,
            'model' => $this->model,
            'record' => $this->record,
        ]);
    }
}
