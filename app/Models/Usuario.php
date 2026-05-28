<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity;

    protected $table = 'usuario';

    protected $fillable = [
        'id_persona',
        'id_rol',
        'email',
        'password',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attributes.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Relación belongsTo con Persona.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id');
    }

    /**
     * Relación belongsTo con Rol.
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id');
    }

    /**
     * Relación uno a muchos con Bitacora.
     */
    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class, 'id_usuario', 'id');
    }
}
