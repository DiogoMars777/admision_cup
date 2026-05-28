<x-guest-layout>
    <div class="login-bg">
        <div>
            <div class="login-card">
                <!-- Back Link -->
                <div style="margin-bottom: 20px;">
                    <a href="{{ route('password.request') }}" style="color: #64748b; text-decoration: none; font-size: 14px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; transition: color 0.15s;" onmouseover="this.style.color='#1e293b'" onmouseout="this.style.color='#64748b'">
                        <span>←</span> Volver
                    </a>
                </div>

                <div class="login-logo">
                    <div class="icon-wrapper">🛡️</div>
                    <h1 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 6px;">Código de Verificación</h1>
                    <p style="font-size: 13.5px; color: #64748b; line-height: 1.4;">
                        Ingresa el código de 6 dígitos enviado a <strong style="color: #1e293b;">{{ $email }}</strong>
                    </p>
                </div>

                @if(session('status'))
                    <div class="alert alert-success" style="margin-bottom: 20px; padding: 12px 16px; font-size: 13px;">
                        <span>✅</span> {{ session('status') }}
                    </div>
                @endif

                @if(session('dev_recovery_code'))
                    <div class="alert alert-info" style="margin-bottom: 20px; padding: 12px 16px; font-size: 13px; border-left-color: #3b82f6; background-color: #eff6ff; color: #1e40af; display: flex; align-items: center; gap: 8px;">
                        <span>💡</span> <span><strong>Prueba Local:</strong> Tu código es <strong style="font-size: 15px; color: #1d4ed8; letter-spacing: 1px;">{{ session('dev_recovery_code') }}</strong>. (Esto se muestra porque la conexión a Gmail aún no está configurada).</span>
                    </div>
                @endif

                @if($errors->has('code'))
                    <div class="alert alert-warning" style="margin-bottom: 20px; padding: 12px 16px; font-size: 13px;">
                        <span>⚠️</span> {{ $errors->first('code') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.verify.submit') }}">
                    @csrf

                    <!-- Verification Code -->
                    <div style="margin-bottom: 24px;">
                        <label class="form-label" style="font-weight: 600; font-size: 13.5px; color: #475569; margin-bottom: 8px; text-align: center; display: block;">Código de 6 dígitos</label>
                        <div class="login-input-group" style="max-width: 240px; margin: 0 auto;">
                            <input type="text" name="code" required autofocus maxlength="6" pattern="[0-9]{6}" placeholder="000000" 
                                style="text-align: center; font-size: 24px; font-weight: 700; letter-spacing: 8px; padding: 12px; border-radius: 12px; border: 2px solid #e2e8f0;">
                        </div>
                    </div>

                    <button type="submit" class="login-btn" style="width: 100%; justify-content: center; margin-top: 10px;">
                        Verificar Código
                    </button>
                </form>
            </div>
            <p class="login-copyright">© {{ date('Y') }} Sistema de Admisión Pre-Universitaria - CUP</p>
        </div>
    </div>
</x-guest-layout>
