<?php

namespace App\Http\Controllers;

use App\Models\GestionAcademica;
use Illuminate\Http\Request;

class GestionAcademicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gestiones = GestionAcademica::paginate(10);
        return view('gestiones.index', compact('gestiones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gestiones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'año' => ['required', 'integer', 'min:2020', 'max:2100'],
            'periodo' => ['required', 'string', 'max:20'],
            'fecha_ini' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_ini'],
        ]);

        // Estado por defecto: Activo
        $validated['estado'] = 'Activo';

        GestionAcademica::create($validated);

        return redirect()->route('gestiones.index')
            ->with('success', 'Planificación Académica creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GestionAcademica $gestione)
    {
        return view('gestiones.edit', ['gestion' => $gestione]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GestionAcademica $gestione)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'año' => ['required', 'integer', 'min:2020', 'max:2100'],
            'periodo' => ['required', 'string', 'max:20'],
            'fecha_ini' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_ini'],
            'estado' => ['required', 'string', 'in:Activo,Inactivo'],
        ]);

        $gestione->update($validated);

        return redirect()->route('gestiones.index')
            ->with('success', 'Planificación Académica actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage (Logical delete).
     */
    public function destroy(GestionAcademica $gestione)
    {
        $gestione->update(['estado' => 'Inactivo']);

        return redirect()->route('gestiones.index')
            ->with('success', 'Planificación Académica dada de baja exitosamente.');
    }
}
