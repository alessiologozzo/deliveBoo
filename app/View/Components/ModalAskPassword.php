<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalAskPassword extends Component
{
    /**
     * Create a new component instance.
     */

    public $route, $method, $mex, $danger;
    
    public function __construct($route, $method, $mex, $danger = "false")
    {
        $this->route = $route;
        $this->method = $method;
        $this->mex = $mex;
        $this->danger = $danger;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-ask-password');
    }
}
