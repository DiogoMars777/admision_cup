<x-app-layout>
    <x-slot name="header">Gestión de Materias</x-slot>

    @if(session('success'))
        <div class="alert alert-success"><span>✅</span> {{ session('success') }}</div>
    @endif

    <div class="content-card">
        <div class="content-card-header">
            <h3>📚 Listado de Materias</h3>
            <a href="{{ route('materias.create') }}" class="btn btn-primary">+ Nueva Materia</a>
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
                    @forelse($materias as $materia)
                        <tr>
                            <td style="font-weight: 600;">{{ $materia->nombre }}</td>
                            <td>{{ $materia->descripcion ?? '—' }}</td>
                            <td><span class="badge-status {{ $materia->estado === 'Activo' ? 'badge-active' : 'badge-inactive' }}">{{ $materia->estado }}</span></td>
                            <td style="text-align: center;">
                                <a href="{{ route('materias.edit', $materia) }}" class="btn btn-edit">Editar</a>
                                @if($materia->estado === 'Activo')
                                    <form action="{{ route('materias.destroy', $materia) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desactivar esta materia?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                    </form>
                                @else
                                    <span style="color: #94a3b8; font-size: 12px;">Inactiva</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-state"><div class="icon">📚</div><p>No se encontraron materias registradas.</p></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding: 16px 20px;">{{ $materias->links() }}</div>
        </div>
    </div>
</x-app-layout>
