<x-app-layout>
    <x-slot name="header">Crear Nueva Materia</x-slot>
    <div class="content-card" style="max-width: 640px;">
        <div class="content-card-header"><h3>📚 Registrar Materia</h3></div>
        <div class="content-card-body" style="padding: 28px;">
            <form action="{{ route('materias.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nombre de la Materia</label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre') }}" required autofocus placeholder="Ej. Matemáticas Básicas">
                    @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" rows="3" class="form-textarea">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <a href="{{ route('materias.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Materia</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
