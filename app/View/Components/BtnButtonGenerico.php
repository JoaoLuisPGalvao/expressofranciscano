<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnButtonGenerico extends Component
{
    public $tipo;
    public $title;
    public $classe;
    public $icone;    

    public function __construct($tipo = '#', $title = 'Title', $classe = 'classe', $icone = 'icone')
    {
        $this->tipo   = $tipo;
        $this->title  = $title;
        $this->classe = $classe;
        $this->icone  = $icone;        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.btn-button-generico');
    }
}
