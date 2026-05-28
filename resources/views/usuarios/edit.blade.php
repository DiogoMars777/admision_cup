<x-app-layout>
    <x-slot name="header">Gestión de Usuarios</x-slot>

    <div class="content-card" style="max-width: 600px; margin: 0 auto;">
        <div class="content-card-header">
            <h3>✏️ Editar Usuario</h3>
            <a href="{{ route('usuarios.index') }}" class="btn" style="background-color: #f1f5f9; color: #475569;">Volver</a>
        </div>
        <div class="content-card-body" style="padding: 24px;">
            <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Persona</label>
                    <input type="text" value="{{ $usuario->persona->nombre ?? '' }} {{ $usuario->persona->apellidos ?? '' }}" disabled style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #64748b; background-color: #f8fafc; outline: none;">
                    <small style="color: #94a3b8; font-size: 12px; display: block; margin-top: 4px;">La persona vinculada al usuario no se puede cambiar.</small>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="id_rol" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Rol de Usuario <span style="color: #ef4444;">*</span></label>
                    <select name="id_rol" id="id_rol" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                        <option value="">Seleccione un rol...</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}" {{ old('id_rol', $usuario->id_rol) == $rol->id ? 'selected' : '' }}>
                                {{ $rol->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_rol')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Correo Electrónico <span style="color: #ef4444;">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                    @error('email')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nueva Contraseña (Opcional)</label>
                    <input type="password" name="password" id="password" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;" placeholder="Dejar en blanco para no cambiar">
                    @error('password')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password_confirmation" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="estado" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Estado <span style="color: #ef4444;">*</span></label>
                    <select name="estado" id="estado" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                        <option value="Activo" {{ old('estado', $usuario->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $usuario->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
                    <a href="{{ route('usuarios.index') }}" class="btn" style="background-color: #f1f5f9; color: #475569;">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
