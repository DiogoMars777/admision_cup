<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // 1. Crear roles básicos si no existen
            $adminRol = Rol::firstOrCreate(
                ['nombre' => 'Administrador'],
                ['descripcion' => 'Personal administrativo con control de accesos y gestión']
            );

            Rol::firstOrCreate(
                ['nombre' => 'Docente'],
                ['descripcion' => 'Personal docente encargado de impartir materias']
            );

            Rol::firstOrCreate(
                ['nombre' => 'Postulante'],
                ['descripcion' => 'Estudiantes inscritos para el examen de admisión']
            );

            // 2. Crear persona asociada
            $persona = Persona::firstOrCreate(
                ['ci' => '1234567'],
                [
                    'nombre' => 'Diogo Mars',
                    'sexo' => 'Masculino',
                    'telefono' => '70000000',
                ]
            );

            // 3. Crear usuario administrativo
            Usuario::updateOrCreate(
                ['email' => 'diogomars2020@gmail.com'],
                [
                    'id_persona' => $persona->id,
                    'id_rol' => $adminRol->id,
                    'password' => Hash::make('admin123'),
                    'estado' => 'Activo',
                ]
            );
        });
    }
}
