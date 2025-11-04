<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Exibe o formulário de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Processa o login do usuário
     */
    public function login(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'cpf' => 'required|string',
            'senha' => 'required|string',
        ]);

        // Busca o usuário pelo CPF
        $usuario = Usuario::where('cpf', $request->cpf)->first();

        // Verifica se existe e se a senha bate (MD5 neste caso)
        if (!$usuario || md5($request->senha) !== $usuario->senha) {
            throw ValidationException::withMessages([
                'cpf' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        // Faz login usando o guard padrão (web)
        Auth::login($usuario);

        // Regenera a sessão por segurança
        $request->session()->regenerate();

        // Redireciona para a rota desejada (ex: mural)
        return redirect()->intended();
    }

    /**
     * Faz logout do usuário
     */
    public function logout(Request $request)
    {
        // Logout usando o guard padrão
        Auth::logout();

        // Invalida a sessão e gera novo token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/pag_init');
    }
}
