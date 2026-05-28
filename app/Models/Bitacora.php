<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacora';

    protected $fillable = [
        'id_usuario',
        'modulo',
        'accion',
        'descripcion',
        'fecha',
        'hora',
        'ip_usuario',
    ];

    /**
     * Relación con el Usuario que realizó la acción.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id');
    }
}
