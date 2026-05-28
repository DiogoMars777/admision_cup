<x-app-layout>
    <x-slot name="header">Editar Planificación Académica</x-slot>

    <div class="content-card" style="max-width: 640px;">
        <div class="content-card-header">
            <h3>✏️ Editar: {{ $gestion->nombre }}</h3>
        </div>
        <div class="content-card-body" style="padding: 28px;">
            <form action="{{ route('gestiones.update', $gestion) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label class="form-label">Nombre de la Convocatoria</label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre', $gestion->nombre) }}" required>
                    @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label class="form-label">Año Académico</label>
                        <input type="number" name="año" class="form-input" value="{{ old('año', $gestion->año) }}" required>
                        @error('año') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Periodo</label>
                        <input type="text" name="periodo" class="form-input" value="{{ old('periodo', $gestion->periodo) }}" required>
                        @error('periodo') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label class="form-label">Fecha de Inicio</label>
                        <input type="date" name="fecha_ini" class="form-input" value="{{ old('fecha_ini', $gestion->fecha_ini) }}">
                        @error('fecha_ini') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fecha de Cierre</label>
                        <input type="date" name="fecha_fin" class="form-input" value="{{ old('fecha_fin', $gestion->fecha_fin) }}">
                        @error('fecha_fin') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="Activo" {{ old('estado', $gestion->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $gestion->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <a href="{{ route('gestiones.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Planificación</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
