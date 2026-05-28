<?php

namespace App\Http\Controllers;

use App\Models\Requisito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requisitos = Requisito::with(['postulante', 'abministrador'])->paginate(15);
        return view('requisitos.index', compact('requisitos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Traemos las personas para asignarle el requisito (postulante)
        $postulantes = \App\Models\Persona::all();
        return view('requisitos.create', compact('postulantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_postulante' => ['required', 'exists:persona,id'],
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'string', 'in:Pendiente,Entregado,Rechazado'], // Restringido
        ]);

        // Captura automática del ID de la persona logueada (rol administrativo)
        $validated['id_abministrador'] = Auth::user()->id_persona;

        Requisito::create($validated);

        return redirect()->route('requisitos.index')
            ->with('success', 'Requisito registrado y asignado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requisito $requisito)
    {
        $postulantes = \App\Models\Persona::all();
        return view('requisitos.edit', compact('requisito', 'postulantes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requisito $requisito)
    {
        $validated = $request->validate([
            'id_postulante' => ['required', 'exists:persona,id'],
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'string', 'in:Pendiente,Entregado,Rechazado'], // Restringido
        ]);

        // Registrar quién realizó la última auditoría/modificación
        $validated['id_abministrador'] = Auth::user()->id_persona;

        $requisito->update($validated);

        return redirect()->route('requisitos.index')
            ->with('success', 'Requisito actualizado correctamente.');
    }

    /**
     * Quick status update from the index view.
     */
    public function updateStatus(Request $request, Requisito $requisito)
    {
        $validated = $request->validate([
            'estado' => ['required', 'string', 'in:Pendiente,Entregado,Rechazado'], // Restringido
        ]);

        // Actualizamos estado y auditor administrativo
        $requisito->update([
            'estado' => $validated['estado'],
            'id_abministrador' => Auth::user()->id_persona,
        ]);

        return redirect()->route('requisitos.index')
            ->with('success', 'Estado del requisito actualizado y auditado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisito $requisito)
    {
        $requisito->delete();

        return redirect()->route('requisitos.index')
            ->with('success', 'Requisito eliminado físicamente.');
    }
}
