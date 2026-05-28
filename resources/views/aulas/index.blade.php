<x-app-layout>
    <x-slot name="header">Gestión de Aulas (Infraestructura)</x-slot>

    @if(session('success'))
        <div class="alert alert-success"><span>✅</span> {{ session('success') }}</div>
    @endif

    <div class="content-card">
        <div class="content-card-header">
            <h3>🏫 Listado de Aulas</h3>
            <a href="{{ route('aulas.create') }}" class="btn btn-primary">+ Registrar Aula</a>
        </div>
        <div class="content-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nº de Aula</th>
                        <th>Capacidad Máxima</th>
                        <th>Tipo de Aula</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aulas as $aula)
                        <tr>
                            <td style="font-weight: 600;">{{ $aula->aula_nro }}</td>
                            <td><span class="badge-status badge-active">{{ $aula->capacidad }} Estudiantes</span></td>
                            <td>{{ $aula->tipo_aula ?? 'Sin definir' }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('aulas.edit', $aula) }}" class="btn btn-edit">Editar</a>
                                <form action="{{ route('aulas.destroy', $aula) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar esta aula permanentemente?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-state"><div class="icon">🏫</div><p>No se encontraron aulas registradas.</p></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding: 16px 20px;">{{ $aulas->links() }}</div>
        </div>
    </div>
</x-app-layout>
