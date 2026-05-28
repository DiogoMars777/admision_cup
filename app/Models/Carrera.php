<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;

class Carrera extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'carrera';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    /**
     * Scope para filtrar solo carreras activas.
     */
    public function scopeActive($query)
    {
        return $query->where('estado', 'Activo');
    }
}
