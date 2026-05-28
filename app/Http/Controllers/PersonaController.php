<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::with('usuario')->paginate(15);
        return response()->json($personas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ci' => ['required', 'string', 'max:20', 'unique:persona,ci'],
            'nombre' => ['required', 'string', 'max:150'],
            'sexo' => ['nullable', 'string', 'max:10'],
            'telefono' => ['nullable', 'string', 'max:20'],
        ]);

        $persona = Persona::create($validated);

        return response()->json([
            'message' => 'Persona creada exitosamente',
            'data' => $persona
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        return response()->json($persona->load('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $persona)
    {
        $validated = $request->validate([
            'ci' => ['required', 'string', 'max:20', 'unique:persona,ci,' . $persona->id],
            'nombre' => ['required', 'string', 'max:150'],
            'sexo' => ['nullable', 'string', 'max:10'],
            'telefono' => ['nullable', 'string', 'max:20'],
        ]);

        $persona->update($validated);

        return response()->json([
            'message' => 'Persona actualizada exitosamente',
            'data' => $persona
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();

        return response()->json([
            'message' => 'Persona eliminada exitosamente'
        ]);
    }
}
