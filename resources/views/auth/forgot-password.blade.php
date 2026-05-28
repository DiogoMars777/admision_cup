<x-guest-layout>
    <div class="login-bg">
        <div>
            <div class="login-card">
                <!-- Back Link -->
                <div style="margin-bottom: 20px;">
                    <a href="{{ route('login') }}" style="color: #64748b; text-decoration: none; font-size: 14px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; transition: color 0.15s;" onmouseover="this.style.color='#1e293b'" onmouseout="this.style.color='#64748b'">
                        <span>←</span> Volver
                    </a>
                </div>

                <div class="login-logo">
                    <div class="icon-wrapper">🔑</div>
                    <h1 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 6px;">Recuperar Contraseña</h1>
                    <p style="font-size: 13.5px; color: #64748b; line-height: 1.4;">Ingresa tu correo para recibir un código de verificación</p>
                </div>

                @if(session('status'))
                    <div class="alert alert-success" style="margin-bottom: 20px; padding: 12px 16px; font-size: 13px;">
                        <span>✅</span> {{ session('status') }}
                    </div>
                @endif

                @if($errors->has('email'))
                    <div class="alert alert-warning" style="margin-bottom: 20px; padding: 12px 16px; font-size: 13px;">
                        <span>⚠️</span> {{ $errors->first('email') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address or CI -->
                    <div style="margin-bottom: 24px;">
                        <label class="form-label" style="font-weight: 600; font-size: 13.5px; color: #475569; margin-bottom: 8px;">Usuario, Correo o CI registrado</label>
                        <div class="login-input-group">
                            <span class="icon" style="font-size: 14px;">👤</span>
                            <input type="text" name="email" value="{{ old('email') }}" required autofocus placeholder="correo@ejemplo.com o Nro. de CI" style="padding-left: 38px;">
                        </div>
                    </div>

                    <button type="submit" class="login-btn" style="width: 100%; justify-content: center;">
                        Enviar código
                    </button>
                </form>
            </div>
            <p class="login-copyright">© {{ date('Y') }} Sistema de Admisión Pre-Universitaria - CUP</p>
        </div>
    </div>
</x-guest-layout>
