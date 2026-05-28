<x-app-layout>
    <x-slot name="header">Gestión de Usuarios</x-slot>

    <div class="content-card" style="max-width: 600px; margin: 0 auto;">
        <div class="content-card-header">
            <h3>➕ Nuevo Usuario</h3>
            <a href="{{ route('usuarios.index') }}" class="btn" style="background-color: #f1f5f9; color: #475569;">Volver</a>
        </div>
        <div class="content-card-body" style="padding: 24px;">
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label for="id_persona" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Persona (Empleado/Docente) <span style="color: #ef4444;">*</span></label>
                    <select name="id_persona" id="id_persona" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                        <option value="">Seleccione una persona...</option>
                        @foreach($personas as $persona)
                            <option value="{{ $persona->id }}" {{ old('id_persona') == $persona->id ? 'selected' : '' }}>
                                {{ $persona->nombre }} {{ $persona->apellidos }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_persona')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="id_rol" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Rol de Usuario <span style="color: #ef4444;">*</span></label>
                    <select name="id_rol" id="id_rol" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                        <option value="">Seleccione un rol...</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}" {{ old('id_rol') == $rol->id ? 'selected' : '' }}>
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
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                    @error('email')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Contraseña <span style="color: #ef4444;">*</span></label>
                    <input type="password" name="password" id="password" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                    @error('password')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password_confirmation" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Confirmar Contraseña <span style="color: #ef4444;">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="estado" style="display: block; font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px;">Estado Inicial <span style="color: #ef4444;">*</span></label>
                    <select name="estado" id="estado" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; outline: none;">
                        <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
                    <a href="{{ route('usuarios.index') }}" class="btn" style="background-color: #f1f5f9; color: #475569;">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
