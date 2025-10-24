<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownAcao extends Component
{
    public $itemId;
    public $fichaRoute;
    public $emailRoute;
    public $emailDisabled;
    public $editRoute;
    public $deleteRoute;

    public function __construct($itemId = null, $fichaRoute = null, $emailRoute = null, $emailDisabled = false, $editRoute = null, $deleteRoute = null) {

        $this->itemId           = $itemId;
        $this->fichaRoute       = $fichaRoute;
        $this->emailRoute       = $emailRoute;
        $this->emailDisabled    = $emailDisabled;
        $this->editRoute        = $editRoute;
        $this->deleteRoute      = $deleteRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown-acao');
    }
}
