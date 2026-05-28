<x-app-layout>
    <x-slot name="header">Control Documental de Requisitos</x-slot>

    @if(session('success'))
        <div class="alert alert-success"><span>✅</span> {{ session('success') }}</div>
    @endif

    <div class="content-card">
        <div class="content-card-header">
            <h3>📋 Requisitos de Postulantes</h3>
            <a href="{{ route('requisitos.create') }}" class="btn btn-primary">+ Asignar Requisito</a>
        </div>
        <div class="content-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Postulante</th>
                        <th>Documento</th>
                        <th>Descripción</th>
                        <th>Evaluador</th>
                        <th>Estado</th>
                        <th style="text-align: center;">Cambio Rápido</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requisitos as $requisito)
                        <tr>
                            <td>
                                <span style="font-weight: 600;">{{ $requisito->postulante->nombre ?? 'N/A' }} {{ $requisito->postulante->paterno ?? '' }}</span>
                                <span style="display: block; font-size: 11px; color: #94a3b8;">CI: {{ $requisito->postulante->ci ?? '' }}</span>
                            </td>
                            <td style="font-weight: 600;">{{ $requisito->nombre }}</td>
                            <td style="color: #64748b; max-width: 180px;">{{ $requisito->descripcion ?? '—' }}</td>
                            <td style="font-size: 12.5px;">
                                @if($requisito->abministrador)
                                    {{ $requisito->abministrador->nombre }} {{ $requisito->abministrador->paterno ?? '' }}
                                @else
                                    <span style="color: #94a3b8; font-style: italic;">No evaluado</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge-status {{ $requisito->estado === 'Entregado' ? 'badge-delivered' : ($requisito->estado === 'Pendiente' ? 'badge-pending' : 'badge-rejected') }}">
                                    {{ $requisito->estado }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('requisitos.status', $requisito) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <select name="estado" onchange="this.form.submit()" class="quick-select">
                                        <option value="Pendiente" {{ $requisito->estado === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="Entregado" {{ $requisito->estado === 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                        <option value="Rechazado" {{ $requisito->estado === 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                                    </select>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('requisitos.edit', $requisito) }}" class="btn btn-edit">Editar</a>
                                <form action="{{ route('requisitos.destroy', $requisito) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar este requisito?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="empty-state"><div class="icon">📋</div><p>No hay requisitos asignados a postulantes.</p></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding: 16px 20px;">{{ $requisitos->links() }}</div>
        </div>
    </div>
</x-app-layout>
