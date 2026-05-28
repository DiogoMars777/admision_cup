<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all();
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:50', 'unique:rol,nombre'],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ]);

        $rol = Rol::create($validated);

        return response()->json([
            'message' => 'Rol creado exitosamente',
            'data' => $rol
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        return response()->json($rol);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rol $rol)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:50', 'unique:rol,nombre,' . $rol->id],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ]);

        $rol->update($validated);

        return response()->json([
            'message' => 'Rol actualizado exitosamente',
            'data' => $rol
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
        // Evitar eliminar roles si tienen usuarios asignados
        if ($rol->usuarios()->exists()) {
            return response()->json([
                'error' => 'No se puede eliminar el rol porque tiene usuarios asociados'
            ], 400);
        }

        $rol->delete();

        return response()->json([
            'message' => 'Rol eliminado exitosamente'
        ]);
    }
}
