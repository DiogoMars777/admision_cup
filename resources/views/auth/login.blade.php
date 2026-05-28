<x-guest-layout>
    <div class="login-bg">
        <div>
            <div class="login-card">
                <div class="login-logo">
                    <div class="icon-wrapper">🎓</div>
                    <h1>¡Bienvenido!</h1>
                    <p>Ingresa al Sistema de Admisión Pre-Universitaria</p>
                </div>

                @if(session('status'))
                    <div class="alert alert-success" style="margin-bottom: 20px;">
                        <span>✅</span> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Usuario o Correo</label>
                        <div class="login-input-group">
                            <span class="icon">👤</span>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="correo@ejemplo.com">
                        </div>
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Contraseña</label>
                        <div class="login-input-group">
                            <span class="icon">🔒</span>
                            <input type="password" name="password" required autocomplete="current-password" placeholder="••••••••" id="password-field">
                        </div>
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 22px;">
                        <input type="checkbox" id="remember" name="remember" style="accent-color: #10b981; width: 16px; height: 16px; cursor: pointer;">
                        <label for="remember" style="font-size: 13px; color: #64748b; cursor: pointer;">Recordarme</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="login-btn">
                        <span>→</span> Ingresar al Sistema
                    </button>

                    <div style="text-align: center; margin-top: 18px;">
                        <a href="{{ route('password.request') }}" style="color: #059669; text-decoration: none; font-size: 13.5px; font-weight: 600; transition: color 0.15s; display: inline-block;" onmouseover="this.style.color='#047857'" onmouseout="this.style.color='#059669'">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>

                <div class="login-footer">
                    <p><strong>ℹ️ Credenciales por defecto:</strong></p>
                    <p><strong>Usuario:</strong> admin@cup.edu.bo</p>
                    <p><strong>Contraseña:</strong> admin123</p>
                </div>
            </div>

            <p class="login-copyright">© {{ date('Y') }} Sistema de Admisión Pre-Universitaria - CUP</p>
        </div>
    </div>
</x-guest-layout>
