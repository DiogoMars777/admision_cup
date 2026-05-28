<x-app-layout>
    <x-slot name="header">Registrar Nueva Aula</x-slot>

    <div class="content-card" style="max-width: 640px;">
        <div class="content-card-header"><h3>🏫 Nueva Aula</h3></div>
        <div class="content-card-body" style="padding: 28px;">
            <form action="{{ route('aulas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Número de Aula / Identificador</label>
                    <input type="text" name="aula_nro" class="form-input" value="{{ old('aula_nro') }}" required autofocus placeholder="Ej. A-101, Laboratorio 2">
                    @error('aula_nro') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Capacidad Máxima</label>
                    <input type="number" name="capacidad" class="form-input" value="{{ old('capacidad') }}" required min="1" placeholder="Ej. 40">
                    <p class="form-hint">Debe ser un número entero positivo mayor a cero.</p>
                    @error('capacidad') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Tipo de Aula (Opcional)</label>
                    <input type="text" name="tipo_aula" class="form-input" value="{{ old('tipo_aula') }}" placeholder="Ej. Teórica, Laboratorio, Auditorio">
                    @error('tipo_aula') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <a href="{{ route('aulas.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Aula</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
