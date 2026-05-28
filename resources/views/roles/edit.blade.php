<x-app-layout>
    <x-slot name="header">Gestión de Roles</x-slot>

    <div class="content-card" style="max-width: 600px; margin: 0 auto;">
        <div class="content-card-header">
            <h3>✏️ Editar Rol</h3>
            <a href="{{ route('roles.index') }}" class="btn" style="background-color: #f1f5f9; color: #475569;">Volver</a>
        </div>
        <div class="content-card-body" style="padding: 24px;">
            <form action="{{ route('roles.update', $rol) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div style="margin-bottom: 20px;">
                    <label for="nombre" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nombre del Rol <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $rol->nombre) }}" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none; transition: border-color 0.2s;">
                    @error('nombre')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="descripcion" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none; transition: border-color 0.2s; resize: vertical;">{{ old('descripcion', $rol->descripcion) }}</textarea>
                    @error('descripcion')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
                    <a href="{{ route('roles.index') }}" class="btn" style="background-color: #f1f5f9; color: #475569;">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Rol</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
