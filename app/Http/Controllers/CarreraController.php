<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Http\Requests\StoreCarreraRequest;
use App\Http\Requests\UpdateCarreraRequest;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Traemos todas las carreras (activas e inactivas) para que el administrador las gestione
        $carreras = Carrera::paginate(10);
        return view('carreras.index', compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carreras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarreraRequest $request)
    {
        Carrera::create($request->validated());

        return redirect()->route('carreras.index')
            ->with('success', 'Carrera creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrera $carrera)
    {
        return view('carreras.edit', compact('carrera'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarreraRequest $request, Carrera $carrera)
    {
        $carrera->update($request->validated());

        return redirect()->route('carreras.index')
            ->with('success', 'Carrera actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage (Logical delete).
     */
    public function destroy(Carrera $carrera)
    {
        // Realizamos un borrado lógico cambiando el estado a Inactivo
        $carrera->update(['estado' => 'Inactivo']);

        return redirect()->route('carreras.index')
            ->with('success', 'Carrera desactivada (borrado lógico) correctamente.');
    }
}
