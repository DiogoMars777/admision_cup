<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;

class Rol extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'rol';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Relación uno a muchos con Usuario.
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_rol', 'id');
    }
}
