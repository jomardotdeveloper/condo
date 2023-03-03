<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    public $logo;
    public $isParent;
    public $url;
    public $name;
    public $children;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $logo, $url, $isParent=false, $children = [])
    {
        $this->name = $name;
        $this->logo = $logo;
        $this->isParent = $isParent;
        $this->url = $url;
        $this->children = $children;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu', [
            'logo' => $this->logo,
            'isParent' => $this->isParent,
            'url' => $this->url,
            'name' => $this->name,
            'children' => $this->children
        ]);
    }
}
