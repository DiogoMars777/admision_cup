<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bitacora::with(['usuario.persona']);

        // Filtrar por usuario
        if ($request->has('id_usuario')) {
            $query->where('id_usuario', $request->id_usuario);
        }

        // Filtrar por acción
        if ($request->has('accion')) {
            $query->where('accion', 'like', '%' . $request->accion . '%');
        }

        // Filtrar por módulo
        if ($request->has('modulo')) {
            $query->where('modulo', 'like', '%' . $request->modulo . '%');
        }

        // Filtrar por fecha
        if ($request->has('fecha')) {
            $query->where('fecha', $request->fecha);
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(30);

        return response()->json($logs);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bitacora $bitacora)
    {
        return response()->json($bitacora->load(['usuario.persona']));
    }
}
