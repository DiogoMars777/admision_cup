<x-app-layout>
    <x-slot name="header">Gestión de Roles</x-slot>

    @if(session('success'))
        <div class="alert alert-success"><span>✅</span> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" style="background-color: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;"><span>❌</span> {{ session('error') }}</div>
    @endif

    <div class="content-card">
        <div class="content-card-header">
            <h3>🔐 Listado de Roles</h3>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">+ Nuevo Rol</a>
        </div>
        <div class="content-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $rol)
                        <tr>
                            <td style="color: #64748b;">#{{ $rol->id }}</td>
                            <td style="font-weight: 600;">{{ $rol->nombre }}</td>
                            <td>{{ $rol->descripcion ?? '—' }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('roles.edit', $rol) }}" class="btn btn-edit">Editar</a>
                                <form action="{{ route('roles.destroy', $rol) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar este rol? Esta acción no se puede deshacer.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-state"><div class="icon">🔐</div><p>No se encontraron roles registrados.</p></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding: 16px 20px;">{{ $roles->links() }}</div>
        </div>
    </div>
</x-app-layout>
