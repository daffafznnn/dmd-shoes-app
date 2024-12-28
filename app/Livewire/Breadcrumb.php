<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Breadcrumb extends Component
{
    public $title;
    public $breadcrumbs = [];

    public function mount()
    {
        $this->title = $this->getTitleFromRoute();
        $this->breadcrumbs = $this->generateBreadcrumbs();
    }

    private function getTitleFromRoute()
    {
        $routeName = Route::currentRouteName();

        if ($routeName) {
            $parts = explode('.', $routeName);
            return ucwords(str_replace(['-', '_'], ' ', end($parts)));
        }

        return 'Page';
    }

    private function generateBreadcrumbs()
    {
        $routeName = Route::currentRouteName();
        $segments = explode('.', $routeName);
        $breadcrumbs = [];

        $breadcrumbs[] = [
            'label' => 'Home',
            'url' => route('admin.dashboard'),
        ];

        if (count($segments) > 1) {
            $prefix = $segments[0];

            if ($prefix === 'admin') {
                $mainSegment = $segments[1];
                $baseRoute = 'admin.' . $mainSegment;

                if (Route::has($baseRoute . '.index')) {
                    $breadcrumbs[] = [
                        'label' => ucwords(str_replace(['-', '_'], ' ', $mainSegment)),
                        'url' => route($baseRoute . '.index'),
                    ];
                }

                if (count($segments) > 2) {
                    $lastSegment = end($segments);
                    $breadcrumbs[] = [
                        'label' => ucwords(str_replace(['-', '_'], ' ', $lastSegment)),
                        'url' => null,
                    ];
                }
            } else if ($prefix === 'master') {
                $mainSegment = $segments[1];
                $baseRoute = 'master.' . $mainSegment;

                if (Route::has($baseRoute . '.index')) {
                    $breadcrumbs[] = [
                        'label' => ucwords(str_replace(['-', '_'], ' ', $mainSegment)),
                        'url' => route($baseRoute . '.index'),
                    ];
                }

                if (count($segments) > 2) {
                    $lastSegment = end($segments);
                    $breadcrumbs[] = [
                        'label' => ucwords(str_replace(['-', '_'], ' ', $lastSegment)),
                        'url' => null,
                    ];
                }
            }
        }

        return $breadcrumbs;
    }

    public function render()
    {
        return view('livewire.breadcrumb');
    }
}

