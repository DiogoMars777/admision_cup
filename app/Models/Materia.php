<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;

class Materia extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'materia';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    /**
     * Scope para filtrar solo materias activas.
     */
    public function scopeActive($query)
    {
        return $query->where('estado', 'Activo');
    }
}
