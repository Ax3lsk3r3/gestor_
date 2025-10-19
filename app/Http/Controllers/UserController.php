<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'employee')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:50',
            'user_name' => 'required|max:50|unique:users,username',
            'password' => 'required|min:3',
        ], [
            'full_name.required' => 'El nombre completo es requerido',
            'user_name.required' => 'El nombre de usuario es requerido',
            'user_name.unique' => 'Este nombre de usuario ya existe',
            'password.required' => 'La contraseña es requerida',
        ]);

        User::create([
            'full_name' => $request->full_name,
            'username' => $request->user_name,
            'password' => Hash::make($request->password),
            'role' => 'employee',
        ]);

        return redirect()->route('users.create')
            ->with('success', '¡Usuario creado exitosamente!');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)
            ->where('role', 'employee')
            ->firstOrFail();
        
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|max:50',
            'user_name' => 'required|max:50|unique:users,username,' . $id,
            'password' => 'nullable|min:3',
        ]);

        $user = User::where('id', $id)
            ->where('role', 'employee')
            ->firstOrFail();

        $data = [
            'full_name' => $request->full_name,
            'username' => $request->user_name,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', '¡Usuario actualizado exitosamente!');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)
            ->where('role', 'employee')
            ->firstOrFail();
        
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', '¡Usuario eliminado exitosamente!');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:50',
            'password' => 'nullable|min:3',
        ]);

        $user = Auth::user();
        
        $data = [
            'full_name' => $request->full_name,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('profile')
            ->with('success', '¡Perfil actualizado exitosamente!');
    }
}
