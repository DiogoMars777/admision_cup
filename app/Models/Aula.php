<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;

class Aula extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'aula';

    protected $fillable = [
        'aula_nro',
        'capacidad',
        'tipo_aula',
    ];
}
