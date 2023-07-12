<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ToastMessage extends Component
{
    /**
     * Create a new component instance.
     */

    public $mex, $failed;

    public function __construct($mex, $failed = false)
    {
        $this->mex = $mex;
        $this->failed = $failed;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toast-message');
    }
}
