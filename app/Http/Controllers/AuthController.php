<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/shows');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (
            $user = User::query()
            ->where('login', $request->login)
            ->first()
        ) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);

                return redirect()->route('dashboard');
            }

            return back()->withErrors([
                'login' => 'Senha incorreta.',
            ]);
        }

        return back()->withErrors([
            'login' => 'Usuário não encontrado.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
