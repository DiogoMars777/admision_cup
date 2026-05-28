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
        $personas = Persona::paginate(10);
        return view('personas.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personas.create');
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

        Persona::create($validated);

        return redirect()->route('personas.index')
            ->with('success', 'Persona creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
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

        return redirect()->route('personas.index')
            ->with('success', 'Persona actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        if ($persona->usuario()->exists()) {
            return redirect()->route('personas.index')
                ->with('error', 'No se puede eliminar la persona porque tiene un usuario asociado.');
        }

        $persona->delete();

        return redirect()->route('personas.index')
            ->with('success', 'Persona eliminada exitosamente.');
    }
}
