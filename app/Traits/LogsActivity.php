<?php

namespace App\Traits;

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

trait LogsActivity
{
    /**
     * Boot the trait to hook into Eloquent model events.
     */
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            static::logAction($model, 'CREAR');
        });

        static::updated(function ($model) {
            static::logAction($model, 'EDITAR');
        });

        static::deleted(function ($model) {
            static::logAction($model, 'ELIMINAR');
        });
    }

    /**
     * Log the action to the bitacora table.
     */
    protected static function logAction($model, string $actionType)
    {
        $userId = Auth::id();

        // Si no hay usuario autenticado (ej. durante el registro), pero el modelo es un Usuario recién creado,
        // registramos la acción con su propio id.
        if (!$userId && $model instanceof \App\Models\Usuario) {
            $userId = $model->id;
        }

        // Si no hay usuario autenticado y no es un modelo Usuario recién creado, no registramos (evita fallos de integridad).
        if (!$userId) {
            return;
        }

        $modelName = strtoupper(class_basename($model));
        $accion = "{$actionType}_{$modelName}";

        // Determinar el módulo dinámicamente
        $modulo = $model->logModule ?? match (class_basename($model)) {
            'Persona', 'Usuario', 'Rol' => 'Seguridad y Acceso',
            'Carrera', 'Materia', 'Aula', 'Especialidad', 'GestionAcademica', 'CupoCarrera' => 'Planificación Académica',
            'Grupo', 'Horario', 'Asistencia' => 'Control de Clases',
            'Pago', 'Comprobante', 'Requisito' => 'Inscripciones y Pagos',
            'Evaluacion', 'Nota', 'Admision' => 'Evaluación y Admisión',
            default => 'General',
        };

        // Detalle de los cambios
        $descripcion = "Se ha realizado la acción {$actionType} en el modelo {$modelName}.";
        
        if ($actionType === 'CREAR') {
            $descripcion .= " Datos creados: " . json_encode($model->getAttributes());
        } elseif ($actionType === 'EDITAR') {
            $changes = $model->getChanges();
            $original = array_intersect_key($model->getRawOriginal(), $changes);
            $descripcion .= " Cambios realizados: " . json_encode([
                'antes' => $original,
                'despues' => $changes
            ]);
        } elseif ($actionType === 'ELIMINAR') {
            $descripcion .= " Datos eliminados: " . json_encode($model->getAttributes());
        }

        Bitacora::create([
            'id_usuario' => $userId,
            'modulo' => $modulo,
            'accion' => $accion,
            'descripcion' => $descripcion,
            'fecha' => Carbon::now()->toDateString(),
            'hora' => Carbon::now()->toTimeString(),
            'ip_usuario' => Request::ip() ?? '127.0.0.1',
        ]);
    }
}
