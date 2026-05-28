<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
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
        $usuarios = Usuario::with(['persona', 'rol'])->paginate(15);
        return response()->json($usuarios);
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return response()->json($usuario->load(['persona', 'rol']));
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

        return response()->json([
            'message' => 'Usuario actualizado exitosamente',
            'data' => $usuario->load(['persona', 'rol'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return response()->json([
            'message' => 'Usuario eliminado exitosamente'
        ]);
    }
}
