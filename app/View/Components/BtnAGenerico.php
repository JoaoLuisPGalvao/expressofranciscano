<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnAGenerico extends Component
{
    public $href;
    public $title;
    public $classe;
    public $icone;
    public $target;

    public function __construct($href = '#', $title = 'Title', $classe = 'classe', $icone = 'icone', $target = '')
    {
        $this->href   = $href;
        $this->title  = $title;
        $this->classe = $classe;
        $this->icone  = $icone;
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.btn-a-generico');
    }
}
