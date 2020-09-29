<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->hasRoles('admin')) {
                return redirect('/admin');
            }
            // Authentication passed...
            return redirect()->intended(route('index'))->withSuccess('Login avvenuto con successo, benvenuto ' . $request->name);
        }

        return redirect()->back()->withErrors('Credenziali di accesso non valide');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login_form');
    }
}
