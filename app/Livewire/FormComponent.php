<?php

namespace App\Livewire;

use Livewire\Component;

class FormComponent extends Component
{
    protected $listeners = ['storeRecord' => 'store', 'updateRecord' => 'update'];

    public $fields;
    public $rules;
    public $options;
    public $formData = [];
    public $action;
    public $recordId;

    public function mount($fields, $rules, $options, $formData = [], $action, $recordId = null)
    {
        $this->fields = $fields;
        $this->rules = $rules;
        $this->options = $options;
        $this->formData = $formData;
        $this->action = $action;
        $this->recordId = $recordId;
    }

    // Event listener untuk store
    public function store($formData)
    {
        // Panggil controller untuk menyimpan data baru
        $controller = new \App\Http\Controllers\Admin\UserController();
        $request = new \Illuminate\Http\Request($formData);
        return $controller->store($request);
    }

    // Event listener untuk update
    public function update($formData, $recordId)
    {
        // Panggil controller untuk memperbarui data
        $user = \App\Models\User::find($recordId);
        $controller = new \App\Http\Controllers\Admin\UserController();
        $request = new \Illuminate\Http\Request($formData);
        return $controller->update($request, $user);
    }

    public function render()
    {
        return view('livewire.form-component');
    }
}

