<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Closure;
use Illuminate\View\Component;

class Maintenance extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $setting = Setting::first();
        return view('components.maintenance', compact('setting'));
    }
}

