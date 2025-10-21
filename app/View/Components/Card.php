<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $size;
    public $shadow;
    public $border;

    public function __construct($size = 'col-12 col-lg-8', $shadow = 'shadow-lg', $border = 'border-0')
    {
        $this->size   = $size;
        $this->shadow = $shadow;
        $this->border = $border;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
