<x-app-layout>
    <x-slot name="header">Gestión de Personas</x-slot>

    @if(session('success'))
        <div class="alert alert-success"><span>✅</span> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" style="background-color: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;"><span>❌</span> {{ session('error') }}</div>
    @endif

    <div class="content-card">
        <div class="content-card-header">
            <h3>👤 Listado de Personas</h3>
            <a href="{{ route('personas.create') }}" class="btn btn-primary">+ Nueva Persona</a>
        </div>
        <div class="content-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>CI</th>
                        <th>Nombre Completo</th>
                        <th>Sexo</th>
                        <th>Teléfono</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($personas as $persona)
                        <tr>
                            <td style="color: #64748b; font-weight: 500;">{{ $persona->ci }}</td>
                            <td style="font-weight: 600;">{{ $persona->nombre }}</td>
                            <td>{{ $persona->sexo ?? '—' }}</td>
                            <td>{{ $persona->telefono ?? '—' }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('personas.edit', $persona) }}" class="btn btn-edit">Editar</a>
                                <form action="{{ route('personas.destroy', $persona) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar esta persona? Esta acción no se puede deshacer.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state"><div class="icon">👤</div><p>No se encontraron personas registradas.</p></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding: 16px 20px;">{{ $personas->links() }}</div>
        </div>
    </div>
</x-app-layout>
