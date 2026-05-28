<x-app-layout>
    <x-slot name="header">Planificación de Gestiones Académicas</x-slot>

    @if(session('success'))
        <div class="alert alert-success"><span>✅</span> {{ session('success') }}</div>
    @endif

    <div class="content-card">
        <div class="content-card-header">
            <h3>📅 Periodos Planificados</h3>
            <a href="{{ route('gestiones.create') }}" class="btn btn-primary">+ Nueva Planificación</a>
        </div>
        <div class="content-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Convocatoria</th>
                        <th>Año</th>
                        <th>Periodo</th>
                        <th>F. Inicio</th>
                        <th>F. Fin</th>
                        <th>Estado</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gestiones as $gestion)
                        <tr>
                            <td style="font-weight: 600;">{{ $gestion->nombre }}</td>
                            <td>{{ $gestion->año }}</td>
                            <td>{{ $gestion->periodo }}</td>
                            <td style="color: #64748b;">{{ $gestion->fecha_ini ?? '—' }}</td>
                            <td style="color: #64748b;">{{ $gestion->fecha_fin ?? '—' }}</td>
                            <td><span class="badge-status {{ $gestion->estado === 'Activo' ? 'badge-active' : 'badge-inactive' }}">{{ $gestion->estado }}</span></td>
                            <td style="text-align: center;">
                                <a href="{{ route('gestiones.edit', $gestion) }}" class="btn btn-edit">Editar</a>
                                @if($gestion->estado === 'Activo')
                                    <form action="{{ route('gestiones.destroy', $gestion) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desactivar esta gestión?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                    </form>
                                @else
                                    <span style="color: #94a3b8; font-size: 12px;">Inactiva</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="empty-state"><div class="icon">📅</div><p>No hay planificaciones académicas registradas.</p></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding: 16px 20px;">{{ $gestiones->links() }}</div>
        </div>
    </div>
</x-app-layout>
