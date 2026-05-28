<x-app-layout>
    <x-slot name="header">Crear Nueva Carrera</x-slot>

    <div class="content-card" style="max-width: 640px;">
        <div class="content-card-header">
            <h3>🎓 Registrar Carrera</h3>
        </div>
        <div class="content-card-body" style="padding: 28px;">
            <form action="{{ route('carreras.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nombre de la Carrera</label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre') }}" required autofocus placeholder="Ej. Ingeniería de Sistemas">
                    @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" rows="3" class="form-textarea" placeholder="Descripción breve de la carrera...">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Estado Inicial</label>
                    <select name="estado" class="form-select">
                        <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <a href="{{ route('carreras.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Carrera</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
