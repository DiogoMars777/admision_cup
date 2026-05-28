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
        $gestiones = GestionAcademica::with('postulante')->paginate(10);
        return view('gestiones.index', compact('gestiones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // En caso de que se necesite enlazar con postulantes al crear
        $postulantes = \App\Models\Persona::all();
        return view('gestiones.create', compact('postulantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'año' => ['required', 'integer', 'min:2020', 'max:2100'], // Coherent year validation
            'periodo' => ['required', 'string', 'max:20'],
            'fecha_ini' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_ini'],
            'id_postulante' => ['nullable', 'exists:persona,id'],
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
    public function edit(GestionAcademica $gestion_academica)
    {
        $postulantes = \App\Models\Persona::all();
        return view('gestiones.edit', compact('gestion_academica', 'postulantes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GestionAcademica $gestion_academica)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'año' => ['required', 'integer', 'min:2020', 'max:2100'],
            'periodo' => ['required', 'string', 'max:20'],
            'fecha_ini' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_ini'],
            'id_postulante' => ['nullable', 'exists:persona,id'],
            'estado' => ['required', 'string', 'in:Activo,Inactivo'],
        ]);

        $gestion_academica->update($validated);

        return redirect()->route('gestiones.index')
            ->with('success', 'Planificación Académica actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage (Logical delete).
     */
    public function destroy(GestionAcademica $gestion_academica)
    {
        $gestion_academica->update(['estado' => 'Inactivo']);

        return redirect()->route('gestiones.index')
            ->with('success', 'Planificación Académica dada de baja (inactiva) exitosamente.');
    }
}
