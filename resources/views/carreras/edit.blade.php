<x-app-layout>
    <x-slot name="header">Editar Carrera</x-slot>

    <div class="content-card" style="max-width: 640px;">
        <div class="content-card-header">
            <h3>✏️ Editar Carrera: {{ $carrera->nombre }}</h3>
        </div>
        <div class="content-card-body" style="padding: 28px;">
            <form action="{{ route('carreras.update', $carrera) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nombre de la Carrera</label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre', $carrera->nombre) }}" required>
                    @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" rows="3" class="form-textarea">{{ old('descripcion', $carrera->descripcion) }}</textarea>
                    @error('descripcion') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="Activo" {{ old('estado', $carrera->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $carrera->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <a href="{{ route('carreras.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Carrera</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
