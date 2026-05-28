<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código de Recuperación</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .header {
            background: linear-gradient(135deg, #10b981, #059669);
            padding: 32px 24px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 8px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 32px;
            color: #334155;
            line-height: 1.6;
        }
        .content h2 {
            font-size: 18px;
            font-weight: 700;
            margin-top: 0;
            color: #1e293b;
        }
        .code-box {
            background-color: #f1f5f9;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            margin: 32px 0;
            border: 1px dashed #cbd5e1;
        }
        .code {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: 6px;
            color: #059669;
            margin: 0;
        }
        .footer {
            background-color: #f8fafc;
            padding: 24px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 4px 0;
        }
        .warning {
            font-size: 13px;
            color: #64748b;
            margin-top: 24px;
            border-top: 1px solid #f1f5f9;
            padding-top: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CUP</h1>
            <p>Sistema de Admisión Pre-Universitaria</p>
        </div>
        <div class="content">
            <h2>Recuperación de Contraseña</h2>
            <p>Hola,</p>
            <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta asociada a este correo electrónico (<strong>{{ $email }}</strong>).</p>
            <p>Usa el siguiente código de verificación de un solo uso para continuar con el restablecimiento de tu contraseña. Este código es válido por 15 minutos.</p>
            
            <div class="code-box">
                <div class="code">{{ $code }}</div>
            </div>

            <p class="warning">
                <strong>Importante:</strong> Si tú no solicitaste este restablecimiento, puedes ignorar este correo de forma segura. Tu contraseña seguirá siendo la misma.
            </p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Sistema de Admisión Pre-Universitaria - CUP</p>
            <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
        </div>
    </div>
</body>
</html>
