<?php

namespace App\View\Components\guest;

use App\Models\Banner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Carousel extends Component
{
    public $banners;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Ambil banner yang aktif berdasarkan status dan tanggal
        $this->banners = Banner::where('status', 1)
            ->where(function ($query) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.guest.carousel');
    }
}
