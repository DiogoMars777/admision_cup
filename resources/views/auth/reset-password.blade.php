<x-guest-layout>
    <div class="login-bg">
        <div>
            <div class="login-card" style="max-width: 460px;">
                <div class="login-logo">
                    <div class="icon-wrapper">🔒</div>
                    <h1 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 6px;">Nueva Contraseña</h1>
                    <p style="font-size: 13.5px; color: #64748b; line-height: 1.4;">Establece tu nueva contraseña de acceso seguro</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-warning" style="margin-bottom: 20px; padding: 12px 16px; font-size: 13px;">
                        <ul style="margin: 0; padding-left: 16px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Passwords Container (Side by Side in desktop, stacked in mobile) -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <!-- Password -->
                        <div>
                            <label class="form-label" style="font-weight: 600; font-size: 11px; text-transform: uppercase; letter-spacing: 0.8px; color: #475569; margin-bottom: 8px;">Contraseña</label>
                            <div class="login-input-group" style="margin-bottom: 0;">
                                <span class="icon">🔒</span>
                                <input type="password" name="password" id="password-input" required placeholder="••••••••" style="padding-left: 38px;">
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="form-label" style="font-weight: 600; font-size: 11px; text-transform: uppercase; letter-spacing: 0.8px; color: #475569; margin-bottom: 8px;">Confirmar</label>
                            <div class="login-input-group" style="margin-bottom: 0;">
                                <span class="icon">🛡️</span>
                                <input type="password" name="password_confirmation" required placeholder="••••••••" style="padding-left: 38px;">
                            </div>
                        </div>
                    </div>

                    <!-- Requirements Checklist (matching image 3 columns layout) -->
                    <div style="background-color: #f8fafc; border-radius: 12px; padding: 18px; border: 1px solid #f1f5f9; margin-bottom: 24px;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <!-- Column 1 -->
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                <div class="requirement-item" id="req-length" style="display: flex; align-items: center; gap: 8px; font-size: 11px; color: #94a3b8; font-weight: 700; letter-spacing: 0.5px;">
                                    <span class="dot" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #cbd5e1; display: inline-block; transition: all 0.2s;"></span>
                                    8+ CARACTERES
                                </div>
                                <div class="requirement-item" id="req-lower" style="display: flex; align-items: center; gap: 8px; font-size: 11px; color: #94a3b8; font-weight: 700; letter-spacing: 0.5px;">
                                    <span class="dot" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #cbd5e1; display: inline-block; transition: all 0.2s;"></span>
                                    MINÚSCULA
                                </div>
                                <div class="requirement-item" id="req-symbol" style="display: flex; align-items: center; gap: 8px; font-size: 11px; color: #94a3b8; font-weight: 700; letter-spacing: 0.5px;">
                                    <span class="dot" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #cbd5e1; display: inline-block; transition: all 0.2s;"></span>
                                    SÍMBOLO
                                </div>
                            </div>
                            
                            <!-- Column 2 -->
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                <div class="requirement-item" id="req-upper" style="display: flex; align-items: center; gap: 8px; font-size: 11px; color: #94a3b8; font-weight: 700; letter-spacing: 0.5px;">
                                    <span class="dot" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #cbd5e1; display: inline-block; transition: all 0.2s;"></span>
                                    MAYÚSCULA
                                </div>
                                <div class="requirement-item" id="req-number" style="display: flex; align-items: center; gap: 8px; font-size: 11px; color: #94a3b8; font-weight: 700; letter-spacing: 0.5px;">
                                    <span class="dot" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #cbd5e1; display: inline-block; transition: all 0.2s;"></span>
                                    NÚMERO
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="login-btn" style="width: 100%; justify-content: center;">
                        Restablecer Contraseña
                    </button>
                </form>
            </div>
            <p class="login-copyright">© {{ date('Y') }} Sistema de Admisión Pre-Universitaria - CUP</p>
        </div>
    </div>

    <!-- Live check script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password-input');
            const lengthReq = document.getElementById('req-length');
            const upperReq = document.getElementById('req-upper');
            const lowerReq = document.getElementById('req-lower');
            const numberReq = document.getElementById('req-number');
            const symbolReq = document.getElementById('req-symbol');

            function updateRequirement(element, isValid) {
                const dot = element.querySelector('.dot');
                if (isValid) {
                    element.style.color = '#10b981';
                    dot.style.borderColor = '#10b981';
                    dot.style.backgroundColor = '#10b981';
                } else {
                    element.style.color = '#94a3b8';
                    dot.style.borderColor = '#cbd5e1';
                    dot.style.backgroundColor = 'transparent';
                }
            }

            passwordInput.addEventListener('input', function() {
                const val = passwordInput.value;

                // 8+ Characters
                updateRequirement(lengthReq, val.length >= 8);

                // Lowercase
                updateRequirement(lowerReq, /[a-z]/.test(val));

                // Uppercase
                updateRequirement(upperReq, /[A-Z]/.test(val));

                // Number
                updateRequirement(numberReq, /[0-9]/.test(val));

                // Symbol (any non-alphanumeric character)
                updateRequirement(symbolReq, /[^A-Za-z0-9]/.test(val));
            });
        });
    </script>
</x-guest-layout>
