<x-app-layout>
    <x-slot name="header">Asignar Requisito a Postulante</x-slot>

    <div class="content-card" style="max-width: 640px;">
        <div class="content-card-header"><h3>📋 Nuevo Requisito</h3></div>
        <div class="content-card-body" style="padding: 28px;">
            <form action="{{ route('requisitos.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Seleccionar Postulante</label>
                    <select name="id_postulante" class="form-select" required>
                        <option value="">— Seleccionar Postulante —</option>
                        @foreach($postulantes as $p)
                            <option value="{{ $p->id }}" {{ old('id_postulante') == $p->id ? 'selected' : '' }}>
                                {{ $p->nombre }} {{ $p->paterno ?? '' }} (CI: {{ $p->ci }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_postulante') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Documento / Requisito</label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre') }}" required placeholder="Ej. Certificado de Bachiller">
                    @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Observaciones (Opcional)</label>
                    <textarea name="descripcion" rows="3" class="form-textarea" placeholder="Ej. Fotocopia simple legalizada">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Estado de la Entrega</label>
                    <select name="estado" class="form-select" required>
                        <option value="Pendiente" {{ old('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Entregado" {{ old('estado') == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                        <option value="Rechazado" {{ old('estado') == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                    </select>
                    @error('estado') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <a href="{{ route('requisitos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Requisito</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
