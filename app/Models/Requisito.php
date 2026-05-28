<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;

class Requisito extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'requisito';

    protected $fillable = [
        'id_abministrador', // Se guarda con 'b' como en la migración
        'id_postulante',
        'nombre',
        'descripcion',
        'estado',
    ];

    /**
     * Relación con el Administrativo (Persona) que verificó el requisito.
     */
    public function abministrador()
    {
        return $this->belongsTo(Persona::class, 'id_abministrador', 'id');
    }

    /**
     * Relación con el Postulante (Persona) al que le pertenece el requisito.
     */
    public function postulante()
    {
        return $this->belongsTo(Persona::class, 'id_postulante', 'id');
    }
}
