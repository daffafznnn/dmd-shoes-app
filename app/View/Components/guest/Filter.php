<?php

namespace App\View\Components\guest;

use App\Models\Category;
use App\Models\ProductMaterial;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{
    public $categories;
    public $materials;
    public $types;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Ambil data kategori dan material dari model
        $this->categories = Category::where('status', 1)->get(); // Menampilkan semua kategori yang aktif
        $this->materials = ProductMaterial::where('status', 1)->get(); // Menampilkan semua material yang aktif
        // Data type statis
        $this->types = ['man', 'woman', 'unisex'];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.guest.filter');
    }
}
