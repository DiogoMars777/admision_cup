<x-app-layout>
    <x-slot name="header">Nueva Planificación Académica</x-slot>

    <div class="content-card" style="max-width: 640px;">
        <div class="content-card-header"><h3>📅 Registrar Planificación</h3></div>
        <div class="content-card-body" style="padding: 28px;">
            <form action="{{ route('gestiones.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nombre de la Convocatoria</label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre') }}" required autofocus placeholder="Ej. Admisión I - 2026">
                    @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label class="form-label">Año Académico</label>
                        <input type="number" name="año" class="form-input" value="{{ old('año', date('Y')) }}" required>
                        @error('año') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Periodo</label>
                        <input type="text" name="periodo" class="form-input" value="{{ old('periodo') }}" required placeholder="Ej. Primer Semestre">
                        @error('periodo') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label class="form-label">Fecha de Inicio (Opcional)</label>
                        <input type="date" name="fecha_ini" class="form-input" value="{{ old('fecha_ini') }}">
                        @error('fecha_ini') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fecha de Cierre (Opcional)</label>
                        <input type="date" name="fecha_fin" class="form-input" value="{{ old('fecha_fin') }}">
                        @error('fecha_fin') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <a href="{{ route('gestiones.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Planificación</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
