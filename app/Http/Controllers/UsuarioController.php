<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with(['persona', 'rol'])->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Rol::all();
        $personas = Persona::doesntHave('usuario')->get(); // Optionally only personas without a user
        return view('usuarios.create', compact('roles', 'personas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_persona' => ['required', 'exists:persona,id'],
            'id_rol' => ['required', 'exists:rol,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:usuario,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'estado' => ['required', 'string', 'max:20'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Usuario::create($validated);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        $roles = Rol::all();
        $personas = Persona::all();
        return view('usuarios.edit', compact('usuario', 'roles', 'personas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $validated = $request->validate([
            'id_rol' => ['required', 'exists:rol,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:usuario,email,' . $usuario->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'estado' => ['required', 'string', 'max:20'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $usuario->update($validated);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->update(['estado' => 'Inactivo']);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario desactivado (borrado lógico) exitosamente.');
    }
}
