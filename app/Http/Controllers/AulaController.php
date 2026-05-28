<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Http\Requests\StoreAulaRequest;
use App\Http\Requests\UpdateAulaRequest;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::paginate(10);
        return view('aulas.index', compact('aulas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aulas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAulaRequest $request)
    {
        Aula::create($request->validated());

        return redirect()->route('aulas.index')
            ->with('success', 'Aula creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aula $aula)
    {
        return view('aulas.edit', compact('aula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAulaRequest $request, Aula $aula)
    {
        $aula->update($request->validated());

        return redirect()->route('aulas.index')
            ->with('success', 'Aula actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aula $aula)
    {
        $aula->delete();

        return redirect()->route('aulas.index')
            ->with('success', 'Aula eliminada físicamente de la infraestructura.');
    }
}
