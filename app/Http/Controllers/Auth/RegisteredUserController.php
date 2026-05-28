<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Pasamos los roles disponibles para que el usuario pueda elegir uno al registrarse
        $roles = \App\Models\Rol::all();
        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ci' => ['required', 'string', 'max:20', 'unique:persona,ci'],
            'nombre' => ['required', 'string', 'max:150'],
            'sexo' => ['nullable', 'string', 'max:10'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'id_rol' => ['required', 'exists:rol,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:usuario,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Ejecutar creación dentro de una transacción de Base de Datos
        $usuario = DB::transaction(function () use ($request) {
            // 1. Crear registro en la tabla persona
            $persona = Persona::create([
                'ci' => $request->ci,
                'nombre' => $request->nombre,
                'sexo' => $request->sexo,
                'telefono' => $request->telefono,
            ]);

            // 2. Crear registro en la tabla usuario enlazado a la persona
            return Usuario::create([
                'id_persona' => $persona->id,
                'id_rol' => $request->id_rol,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'estado' => 'Activo',
            ]);
        });

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect(route('dashboard', absolute: false));
    }
}
