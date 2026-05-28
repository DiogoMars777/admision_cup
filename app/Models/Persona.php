<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;

class Persona extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'persona';

    protected $fillable = [
        'ci',
        'nombre',
        'sexo',
        'telefono',
    ];

    /**
     * Relación uno a uno con Usuario.
     */
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id_persona', 'id');
    }
}
