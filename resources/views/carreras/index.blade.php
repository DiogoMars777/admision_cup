<x-app-layout>
    <x-slot name="header">Gestión de Carreras</x-slot>

    @if(session('success'))
        <div class="alert alert-success">
            <span>✅</span> {{ session('success') }}
        </div>
    @endif

    <div class="content-card">
        <div class="content-card-header">
            <h3>📋 Listado de Carreras</h3>
            <a href="{{ route('carreras.create') }}" class="btn btn-primary">
                + Nueva Carrera
            </a>
        </div>
        <div class="content-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carreras as $carrera)
                        <tr>
                            <td style="font-weight: 600;">{{ $carrera->nombre }}</td>
                            <td style="max-width: 280px;">{{ $carrera->descripcion ?? '—' }}</td>
                            <td>
                                <span class="badge-status {{ $carrera->estado === 'Activo' ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $carrera->estado }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('carreras.edit', $carrera) }}" class="btn btn-edit">Editar</a>
                                @if($carrera->estado === 'Activo')
                                    <form action="{{ route('carreras.destroy', $carrera) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desactivar esta carrera?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                    </form>
                                @else
                                    <span style="color: #94a3b8; font-size: 12px;">Inactiva</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">
                                <div class="icon">🎓</div>
                                <p>No se encontraron carreras registradas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding: 16px 20px;">{{ $carreras->links() }}</div>
        </div>
    </div>
</x-app-layout>
