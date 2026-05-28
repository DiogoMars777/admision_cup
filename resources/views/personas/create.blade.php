<x-app-layout>
    <x-slot name="header">Gestión de Personas</x-slot>

    <div class="content-card" style="max-width: 600px; margin: 0 auto;">
        <div class="content-card-header">
            <h3>➕ Nueva Persona</h3>
            <a href="{{ route('personas.index') }}" class="btn" style="background-color: #f1f5f9; color: #475569;">Volver</a>
        </div>
        <div class="content-card-body" style="padding: 24px;">
            <form action="{{ route('personas.store') }}" method="POST">
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label for="ci" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Carnet de Identidad (CI) <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="ci" id="ci" value="{{ old('ci') }}" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none; transition: border-color 0.2s;">
                    @error('ci')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="nombre" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nombre Completo <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none; transition: border-color 0.2s;">
                    @error('nombre')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="sexo" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Sexo</label>
                    <select name="sexo" id="sexo" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                        <option value="">Seleccione...</option>
                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                        <option value="Otro" {{ old('sexo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('sexo')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="telefono" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none; transition: border-color 0.2s;">
                    @error('telefono')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
                    <a href="{{ route('personas.index') }}" class="btn" style="background-color: #f1f5f9; color: #475569;">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Persona</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
