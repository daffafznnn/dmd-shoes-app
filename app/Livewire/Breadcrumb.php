<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Breadcrumb extends Component
{
    public $breadcrumbs = [];

    public function mount()
    {
        $this->breadcrumbs = $this->generateBreadcrumbs();
    }

    private function generateBreadcrumbs()
    {
        $routeName = Route::currentRouteName(); // Ambil nama route aktif
        if (!$routeName) {
            return [];
        }

        $segments = explode('.', $routeName); // Pisah nama route berdasarkan "."
        $breadcrumbs = [];
        $currentRoute = '';

        // Tambahkan breadcrumb Home
        $breadcrumbs[] = [
            'label' => 'Home',
            'url' => route('admin.dashboard'), // Misalnya Home mengarah ke dashboard admin
        ];

        // Generate breadcrumb berdasarkan segmen route
        if (count($segments) > 0) {
            // Untuk route utama seperti users, products, dll.
            $firstSegment = $segments[1]; // Misal users, products
            $breadcrumbs[] = [
                'label' => ucwords(str_replace(['-', '_'], ' ', $firstSegment)),
                'url' => route('admin.' . $firstSegment . '.index'), // Misalnya admin.users.index
            ];
        }

        // Jika ada submenu seperti create atau edit
        if (count($segments) > 1) {
            $secondSegment = $segments[2]; // Misal create, edit
            $breadcrumbs[] = [
                'label' => ucwords(str_replace(['-', '_'], ' ', $secondSegment)),
                'url' => null, // Tidak perlu URL karena ini submenu (current page)
            ];
        }

        return $breadcrumbs;
    }

    public function render()
    {
        return view('livewire.breadcrumb');
    }
}
