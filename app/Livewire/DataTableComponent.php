<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class DataTableComponent extends Component
{
    use WithPagination;

    public $search = ''; // Untuk pencarian
    public $perPage = 10; // Jumlah data per halaman
    public $model; // Model yang digunakan (misalnya User atau Product)
    public $columns = []; // Kolom yang ditampilkan
    public $actions = []; // Aksi seperti Edit, Delete, dll.
    public $edit_route; // Kustomisasi route untuk edit
    public $delete_route; // Kustomisasi route untuk delete

    public function mount($model, $columns, $actions = [], $edit_route = null, $delete_route = null)
    {
        // Inisialisasi model dan kolom dari parameter
        $this->model = $model;
        $this->columns = $columns;
        $this->actions = $actions;
        $this->edit_route = $edit_route;
        $this->delete_route = $delete_route;
    }

    // Menyusun query untuk mendapatkan data dari model
    public function getData()
    {
        // Filter data berdasarkan pencarian
        return $this->model::query()
            ->when($this->search, function ($query) {
                foreach ($this->columns as $column) {
                    $query->orWhere($column, 'like', '%' . $this->search . '%');
                }
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        $data = $this->getData();

        return view('livewire.data-table-component', [
            'data' => $data,
        ]);
    }

    // Untuk menangani pencarian
    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination saat pencarian berubah
    }

    // Untuk menghapus data
    public function delete($id)
    {
        $model = $this->model::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Data berhasil dihapus!');
        }
    }
}
