<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public $columns;
    public $data;

    public function __construct($columns = [], $data = [])
    {
        $this->columns = $columns;
        $this->data = $data;
    }

    public function render()
    {
        return view('components.table');
    }
}