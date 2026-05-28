<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Http\Requests\StoreMateriaRequest;
use App\Http\Requests\UpdateMateriaRequest;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materias = Materia::paginate(10);
        return view('materias.index', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMateriaRequest $request)
    {
        Materia::create($request->validated());

        return redirect()->route('materias.index')
            ->with('success', 'Materia creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materia $materia)
    {
        return view('materias.edit', compact('materia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMateriaRequest $request, Materia $materia)
    {
        $materia->update($request->validated());

        return redirect()->route('materias.index')
            ->with('success', 'Materia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage (Logical delete).
     */
    public function destroy(Materia $materia)
    {
        $materia->update(['estado' => 'Inactivo']);

        return redirect()->route('materias.index')
            ->with('success', 'Materia desactivada (borrado lógico) correctamente.');
    }
}
