<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalAsk extends Component
{
    /**
     * Create a new component instance.
     */

    public $mex, $route, $method, $danger, $password;
    
    public function __construct($mex, $route = false, $method = false, $danger = false, $password = false)
    {
        $this->mex = $mex;
        $this->route = $route;
        $this->method = $method;
        $this->danger = $danger;
        $this->password = $password;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-ask');
    }
}
