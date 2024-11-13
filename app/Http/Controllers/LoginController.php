<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    /**
     * Carrega a tela de login
     * Se o usuários tiver logado redireciona para a página home
     */
    public function login()
    {
        if (Auth::user()) return redirect('/');

        return Inertia::render('Login/Screen');
    }

    /**
     * Autentica a o usuário e redireciona para a página home
     *
     * @param LoginRequest $request
     *
     * @return void
     */
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'credentials' => 'Credencias inválidas.',
            ]);
        }

        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * Desloga o usuário e move para a tela de login
     *
     * @param Request $request
     *
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
