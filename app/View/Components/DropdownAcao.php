<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownAcao extends Component
{
    public $itemId;
    public $emailRoute;
    public $emailDisabled;
    public $editRoute;
    public $deleteRoute;
    public $fichaRoute;
    public $fichaLabel;
    public $aprovarRoute;    
    public $aprovarLabel;   
    public $aprovarDisabled;   

    public function __construct($itemId = null, $emailRoute = null, $emailDisabled = false, $editRoute = null, $deleteRoute = null, $fichaRoute = null, $fichaLabel = null, $aprovarRoute = null, $aprovarLabel = null, $aprovarDisabled = false) {

        $this->itemId           = $itemId;
        $this->emailRoute       = $emailRoute;
        $this->emailDisabled    = $emailDisabled;
        $this->editRoute        = $editRoute;
        $this->deleteRoute      = $deleteRoute;
        $this->fichaRoute       = $fichaRoute;
        $this->fichaLabel       = $fichaLabel;
        $this->aprovarRoute     = $aprovarRoute;
        $this->aprovarLabel     = $aprovarLabel;        
        $this->aprovarDisabled  = $aprovarDisabled;        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown-acao');
    }
}
