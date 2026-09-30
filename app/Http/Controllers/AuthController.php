<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Показать форму входа
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Обработать вход
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/users');
        }

        return back()->withErrors(['email' => 'Неверный email или пароль']);
    }

    // Выход
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
