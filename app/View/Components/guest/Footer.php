<?php

namespace App\View\Components\guest;

use App\Models\SocialSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public $socials;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Mengambil data socials langsung dari model SocialSetting
        $this->socials = SocialSetting::all(); // Mengambil semua data social setting
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.guest.footer');
    }
}
