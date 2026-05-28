<x-app-layout>
    <x-slot name="header">Gestión de Usuarios</x-slot>

    @if(session('success'))
        <div class="alert alert-success"><span>✅</span> {{ session('success') }}</div>
    @endif

    <div class="content-card">
        <div class="content-card-header">
            <h3>👥 Listado de Usuarios</h3>
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">+ Nuevo Usuario</a>
        </div>
        <div class="content-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr>
                            <td style="font-weight: 600;">{{ $usuario->persona->nombre ?? 'N/A' }} {{ $usuario->persona->apellidos ?? '' }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td><span class="badge" style="background-color: #f1f5f9; color: #475569;">{{ $usuario->rol->nombre ?? 'Sin Rol' }}</span></td>
                            <td><span class="badge-status {{ $usuario->estado === 'Activo' ? 'badge-active' : 'badge-inactive' }}">{{ $usuario->estado }}</span></td>
                            <td style="text-align: center;">
                                <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-edit">Editar</a>
                                @if($usuario->estado === 'Activo')
                                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desactivar este usuario?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                    </form>
                                @else
                                    <span style="color: #94a3b8; font-size: 12px;">Inactivo</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state"><div class="icon">👥</div><p>No se encontraron usuarios registrados.</p></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding: 16px 20px;">{{ $usuarios->links() }}</div>
        </div>
    </div>
</x-app-layout>
