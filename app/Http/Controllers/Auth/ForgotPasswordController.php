<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Mail\SendResetCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Show the form to request a password reset code.
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a password reset code to the user.
     */
    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'], // can be email or CI
        ]);

        $input = $request->input('email');

        // Check if user exists and is active (habilitado)
        $user = Usuario::where('estado', 'Activo')
            ->where(function ($query) use ($input) {
                $query->where('email', $input)
                      ->orWhereHas('persona', function ($q) use ($input) {
                          $q->where('ci', $input);
                      });
            })
            ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'No podemos encontrar un usuario habilitado con ese correo o número de CI.',
            ])->onlyInput('email');
        }

        $email = $user->email;

        // Rate limit sending code requests to 3 requests per 5 minutes per IP/email
        $throttleKey = 'send_code_attempts:' . $email . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);
            return back()->withErrors([
                'email' => "Demasiados intentos de envío. Por favor, espere {$minutes} minutos antes de intentarlo de nuevo.",
            ])->onlyInput('email');
        }

        // Generate 6 digit code
        $code = strval(rand(100000, 999999));

        // Save token in DB
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $code,
                'created_at' => now(),
            ]
        );

        // Record request attempt
        RateLimiter::hit($throttleKey, 300); // 5 minutes lockout

        $sentSuccessfully = false;

        try {
            Mail::to($email)->send(new SendResetCodeMail($code, $email));
            $sentSuccessfully = true;
        } catch (\Exception $e) {
            // Log the error
            logger()->error('Error sending reset email to ' . $email . ': ' . $e->getMessage());
            
            // Dev fallback: store code in session to help developer test without real Gmail settings
            if (config('app.debug') === true) {
                session(['dev_recovery_code' => $code]);
            }
        }

        // Store email in session to carry over to verify step
        session(['reset_email' => $email]);

        // Obfuscate email for security feed back: e.g. diog***@gmail.com
        $emailParts = explode('@', $email);
        $name = $emailParts[0];
        $domain = $emailParts[1] ?? 'gmail.com';
        $length = strlen($name);
        $visible = min(3, $length);
        $obfuscatedEmail = substr($name, 0, $visible) . str_repeat('*', max(1, $length - $visible)) . '@' . $domain;

        if ($sentSuccessfully) {
            $message = 'Hemos enviado el código de verificación al correo registrado: ' . $obfuscatedEmail;
        } else {
            $message = 'Código generado. Hubo un problema enviando el correo a ' . $obfuscatedEmail . ', pero puedes verificarlo en logs o pantalla de desarrollo.';
        }

        return redirect()->route('password.verify')->with('status', $message);
    }

    /**
     * Show the form to verify the password reset code.
     */
    public function showVerifyCodeForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-code', ['email' => session('reset_email')]);
    }

    /**
     * Verify the code.
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('password.request');
        }

        // Rate limit verify attempts to 3 per 5 minutes per email/IP
        $throttleKey = 'verify_code_attempts:' . $email . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);
            return back()->withErrors([
                'code' => "Su cuenta ha sido bloqueada temporalmente debido a demasiados intentos fallidos. Intente de nuevo en {$minutes} minutos.",
            ]);
        }

        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        // Check if code exists and is not older than 15 minutes
        if (!$record || $record->token !== $request->input('code') || now()->diffInMinutes($record->created_at) > 15) {
            RateLimiter::hit($throttleKey, 300); // 5 minutes lockout increment

            $remaining = RateLimiter::remaining($throttleKey, 3);
            $message = 'El código de verificación ingresado es incorrecto o ha expirado.';
            if ($remaining > 0) {
                $message .= " Le quedan {$remaining} intentos.";
            } else {
                $message .= ' Has superado el límite de intentos. Bloqueado por 5 minutos.';
            }

            return back()->withErrors([
                'code' => $message,
            ]);
        }

        // Clear verification rate limit and DB token
        RateLimiter::clear($throttleKey);
        
        // Save verification flag in session
        session(['code_verified' => true]);

        // Clean up dev recovery helper
        session()->forget('dev_recovery_code');

        return redirect()->route('password.reset');
    }

    /**
     * Show the form to reset the password.
     */
    public function showResetForm()
    {
        if (!session('reset_email') || !session('code_verified')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request)
    {
        $email = session('reset_email');
        if (!$email || !session('code_verified')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8', // 8+ Caracteres
                'confirmed',
                'regex:/[a-z]/',      // Minúscula
                'regex:/[A-Z]/',      // Mayúscula
                'regex:/[0-9]/',      // Número
                'regex:/[^A-Za-z0-9]/', // Símbolo
            ],
        ], [
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe cumplir con todos los requisitos de seguridad.',
            'password.confirmed' => 'Las contraseñas ingresadas no coinciden.',
        ]);

        $user = Usuario::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('password.request')->withErrors(['email' => 'No pudimos procesar la solicitud. Intente de nuevo.']);
        }

        // Update password
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Clear database token and session flags
        DB::table('password_reset_tokens')->where('email', $email)->delete();
        session()->forget(['reset_email', 'code_verified', 'dev_recovery_code']);

        // Clear send code rate limit block for this email
        RateLimiter::clear('send_code_attempts:' . $email . '|' . $request->ip());

        return redirect()->route('login')->with('status', 'Su contraseña ha sido restablecida exitosamente. Ahora puede iniciar sesión.');
    }
}
