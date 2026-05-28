<x-guest-layout>
    <div class="login-bg">
        <div>
            <div class="login-card">
                <div class="login-logo">
                    <div class="icon-wrapper">🎓</div>
                    <h1>Crear Cuenta</h1>
                    <p>Regístrate en el Sistema de Admisión</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">CI (Cédula de Identidad)</label>
                        <input type="text" name="ci" class="form-input" value="{{ old('ci') }}" required autofocus placeholder="Ej. 12345678">
                        @error('ci') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-input" value="{{ old('nombre') }}" required placeholder="Ej. Juan Pérez">
                        @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div class="form-group">
                            <label class="form-label">Sexo</label>
                            <select name="sexo" class="form-select">
                                <option value="">— Seleccionar —</option>
                                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-input" value="{{ old('telefono') }}" placeholder="Ej. 70012345">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Rol</label>
                        <select name="id_rol" class="form-select" required>
                            <option value="">— Seleccionar Rol —</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}" {{ old('id_rol') == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_rol') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email') }}" required placeholder="correo@ejemplo.com">
                        @error('email') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div class="form-group">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-input" required>
                            @error('password') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-input" required>
                        </div>
                    </div>

                    <button type="submit" class="login-btn" style="margin-top: 8px;">
                        Registrarme
                    </button>

                    <p style="text-align: center; margin-top: 16px; font-size: 13px; color: #64748b;">
                        ¿Ya tienes cuenta? <a href="{{ route('login') }}" style="color: #10b981; font-weight: 600;">Inicia Sesión</a>
                    </p>
                </form>
            </div>
            <p class="login-copyright">© {{ date('Y') }} Sistema de Admisión Pre-Universitaria - CUP</p>
        </div>
    </div>
</x-guest-layout>
