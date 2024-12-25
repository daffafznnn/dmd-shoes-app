<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        $model = User::class;
        $action = 'create';
        $fields = [
            'name' => 'text',
            'email' => 'email',
            'password' => 'password',
            'role' => 'select', // role harus ada di fields
        ];

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user', // validasi role
        ];

        $options = [
            'role' => [
                'admin' => 'Admin',
                'user' => 'User',
            ],
        ];

        return view('admin.users.create', compact('fields', 'rules', 'options', 'model', 'action'));
    }

    public function edit(User $user)
    {   
        $model = User::class;
        $action = 'edit';
        $recordId = $user->id;
        $fields = [
            'name' => 'text',
            'email' => 'email',
            'password' => 'password',
            'role' => 'select', // role harus ada di fields
        ];

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,user',
        ];

        $options = [
            'role' => [
                'admin' => 'Admin',
                'user' => 'User',
            ],
        ];

        // Form data
        $formData = $user->toArray();

        return view('admin.users.edit', compact('fields', 'rules', 'options', 'formData', 'model', 'recordId', 'action'));
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dibuat.');
    }

    // Memperbarui data pengguna
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('message', 'User deleted successfully!');
        return response()->json(['success' => true]);
    }
}
