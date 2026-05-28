<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;

class GestionAcademica extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'gestion_academica';

    protected $fillable = [
        'id_postulante', // Aunque la gestión sea general, se mantiene por la estructura de migración
        'nombre',
        'año',
        'periodo',
        'fecha_ini',
        'fecha_fin',
        'estado',
    ];

    /**
     * Relación con un Postulante (Persona) si la migración lo requiere directamente.
     */
    public function postulante()
    {
        return $this->belongsTo(Persona::class, 'id_postulante', 'id');
    }

    /**
     * Relación uno a muchos con Grupo.
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'id_gestionacademica', 'id');
    }

    /**
     * Relación uno a muchos con Evaluaciones.
     */
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'id_gestionacademica', 'id');
    }

    /**
     * Relación uno a muchos con Admisiones.
     */
    public function admisiones()
    {
        return $this->hasMany(Admision::class, 'id_gestionacademica', 'id');
    }

    /**
     * Scope para filtrar solo gestiones activas.
     */
    public function scopeActive($query)
    {
        return $query->where('estado', 'Activo');
    }
}
