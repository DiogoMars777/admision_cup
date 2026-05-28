<x-app-layout>
    <x-slot name="header">Panel de Control</x-slot>

    <!-- Welcome Alert -->
    <div class="alert alert-success">
        <span>✅</span> ¡Bienvenido, {{ Auth::user()->persona->nombre ?? 'Administrador' }}! Has iniciado sesión correctamente.
    </div>

    <h2 style="font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 4px;">
        ¡Hola, {{ Auth::user()->persona->nombre ?? 'Administrador' }}! 👋
    </h2>
    <p style="color: #64748b; font-size: 13.5px; margin-bottom: 24px;">
        Resumen del sistema — {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM') }}
    </p>

    <!-- Stat Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 28px;">
        <div class="stat-card stat-blue">
            <span class="badge">REGISTROS</span>
            <div class="icon">🎓</div>
            <h3>Carreras</h3>
            <div class="value">{{ \App\Models\Carrera::count() }}</div>
            <div class="subtitle">{{ \App\Models\Carrera::where('estado','Activo')->count() }} activas</div>
        </div>

        <div class="stat-card stat-green">
            <span class="badge">CATÁLOGO</span>
            <div class="icon">📚</div>
            <h3>Materias</h3>
            <div class="value">{{ \App\Models\Materia::count() }}</div>
            <div class="subtitle">{{ \App\Models\Materia::where('estado','Activo')->count() }} activas</div>
        </div>

        <div class="stat-card stat-amber">
            <span class="badge">INFRA.</span>
            <div class="icon">🏫</div>
            <h3>Aulas</h3>
            <div class="value">{{ \App\Models\Aula::count() }}</div>
            <div class="subtitle">{{ \App\Models\Aula::sum('capacidad') }} cap. total</div>
        </div>

        <div class="stat-card stat-violet">
            <span class="badge">ACTIVOS</span>
            <div class="icon">👥</div>
            <h3>Usuarios</h3>
            <div class="value">{{ \App\Models\Usuario::count() }}</div>
            <div class="subtitle">{{ \App\Models\Rol::count() }} roles definidos</div>
        </div>
    </div>

    <!-- Content Cards Row -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <!-- Actividad Reciente -->
        <div class="content-card">
            <div class="content-card-header">
                <h3>📋 Actividad Reciente — Bitácora</h3>
            </div>
            <div class="content-card-body">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Acción</th>
                            <th>Módulo</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Bitacora::orderBy('created_at','desc')->take(5)->get() as $log)
                            <tr>
                                <td style="font-weight: 600; font-size: 12.5px;">{{ $log->accion }}</td>
                                <td>
                                    <span class="badge-status badge-active" style="font-size: 10.5px;">{{ $log->modulo ?? 'General' }}</span>
                                </td>
                                <td style="font-size: 12px; color: #94a3b8;">{{ $log->fecha }} {{ $log->hora }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: #94a3b8; padding: 32px;">Sin actividad registrada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Gestiones Académicas -->
        <div class="content-card">
            <div class="content-card-header">
                <h3>📅 Gestiones Académicas Activas</h3>
            </div>
            <div class="content-card-body">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Convocatoria</th>
                            <th>Año</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\GestionAcademica::where('estado','Activo')->take(5)->get() as $gestion)
                            <tr>
                                <td style="font-weight: 600;">{{ $gestion->nombre }}</td>
                                <td>{{ $gestion->año }}</td>
                                <td><span class="badge-status badge-active">Activo</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: #94a3b8; padding: 32px;">Sin gestiones activas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
